<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Recurso extends Model
{
    protected $table = 'recursos';
    public    $timestamps = false;
    public    $modelName = 'Recurso';
    protected $fillable = array('nome', 'sigla','descricao','tipo_recurso','valor','conta_contabil');
    

    public static function addNeededRecursos(array $recursos)
    {
        if (count($recursos) === 0) {
            return;
        }

        $found = static::whereIn('nome', $recursos)->lists('nome')->all();

        foreach (array_diff($recursos, $found) as $recurso) {
            static::create([
                'nome' => $recurso,
                'sigla' => $recurso
            ]);
        }
    }

    public function getValorAttribute($valor)
    {
        return number_format($valor, 2, ',', '.');
    }


    /**
     * Retorna uma lista com os centros de responsabilidades
     * @return boolean
     */
    public function listRecursos($wherein = false){


        try {
               $mRecursos = self::orderBy('nome','asc');
            if($wherein){
               $mRecursos->whereIn('tipo_recurso',[1,3,4]);
            }
               $recursos = $mRecursos->get();
               $arr = array();
               $i = 0;

            foreach($recursos as $r){
                    $arr[$i]['id']   = $r->id;
                    $arr[$i]['nome'] = $r->nome;
                    $arr[$i]['tipo'] = $r->tipo_recurso;
                $i++;
            }

            $auxRecursos = array();

            foreach ($arr as $k => $v) {
               $auxRecursos[iRcGetSysVal_('TIPO_RECURSO',$v['tipo'])][$v['nome']] = substr($v['nome'],0,250) ;
            }

            return  $auxRecursos;

        } catch(\Exception $e) {
            return FALSE;
        }
    }



    /**
     * Retorna uma lista com recurso filtrado por tipo, com agrupamento
     * @param array $tipo array com a lista dos tipos
     * @return array|bool
     */
    public function listRecursoByTipo(array $tipo){

        try {
               $mRecursos = self::orderBy('nome','asc');
            if($tipo){
               $mRecursos->whereIn('tipo_recurso',$tipo);
            }
              $recursos = $mRecursos->get();
              $arr = array();
              $i = 0;

            foreach($recursos as $r){
                $arr[$i]['id']   = $r->id;
                $arr[$i]['nome'] = $r->nome;
                $arr[$i]['tipo'] = $r->tipo_recurso;
                $i++;
            }

            $auxRecursos = array();

            foreach ($arr as $k => $v) {
                $auxRecursos[iRcGetSysVal_('TIPO_RECURSO',$v['tipo'])][$v['id']] = substr($v['nome'],0,250) ;
            }

            return  $auxRecursos;

        } catch(\Exception $e) {
            return FALSE;
        }
    }



    /**
     * @return array|bool
     */
/*
    public function listRecursosWithIDxxxxxxxxxxxxxxxxx(){

        try {

            $recursos = self::all()->sortBy('nome');
            $arr = array();
            $i = 0;
            foreach($recursos as $r){
                $arr[$i]['id']   = $r->id;
                $arr[$i]['nome'] = $r->nome;
                $arr[$i]['tipo'] = $r->tipo_recurso;
                $i++;
            }
            $auxRecursos = array();
            foreach ($arr as $k => $v) {
                $auxRecursos[iRcGetSysVal_('TIPO_RECURSO',$v['tipo'])][$v['id']] = substr($v['nome'],0,250) ;
            }
            return  $auxRecursos;

        } catch(\Exception $e) {
            return FALSE;
        }
    }
*/

    /**
     * @param $data
     * @param $horaInicio
     * @param $horaFim
     * @param $idEspacoAtual
     * @return array
     */
    public function listRecursosAlimentacaoAjax($unidade,$idOrcamento)
    {
        try{

            // $itemSelecionado = "where('pr.recurso_id', '=', $idOrcamento)";

            $listaRecursos = DB::table('orcamento as o')
                ->select(
                    'o.recurso_id',
                    'o.id as orc_id',
                    'r.nome',
                    'c.codigo as cr',
                    'r.valor',
                    'o.quantidade',
                    'o.centro_id',
                    'pr.quantidade as qtd_sol',
                    DB::raw('SUM(pr.quantidade) AS totalRecursoUsado,
                             ep.dt_realizacao,
                             ep.evento_id,
                             YEAR(ep.dt_realizacao) AS ano,
                             COALESCE((o.quantidade - COALESCE(SUM(pr.quantidade),0)),0) AS disponivel'
                    ))
                ->join('recursos as r', 'r.id', '=', 'o.recurso_id')
                ->leftjoin('periodo_recurso as pr', 'pr.orcamento_id', '=', 'o.id')
                ->leftjoin('evento_periodo as ep', 'ep.id', '=', 'pr.periodo_id')
                ->join('centroresp as c', 'c.id', '=', 'o.centro_id') ;

            if($unidade){
               $listaRecursos->where('o.unidade_id', '=', $unidade)->orderBy('r.nome','asc');

            }
            if($idOrcamento){
               $listaRecursos->where('o.id', '=', $idOrcamento);
               // $listaRecursos->where('o.recurso_id', '=', $idOrcamento);
            }
              $listaRecursos->whereRaw('o.ano >= YEAR(CURDATE())')->groupBy('o.recurso_id')->groupBy('o.centro_id');

            return $listaRecursos->get() ;
           //  return $listaRecursos->toSql() ;

        } catch (\Illuminate\Database\QueryException $e) {
            echo "ERRO: ".$e->getSql();
        }
    }


    public function orcamento(){
        //return $this->belongsTo('IrcScheduledRoom\Models\Orcamento','id','recurso_id');
        return $this->belongsTo(Orcamento::class,'id','recurso_id');
    }


    public function recursoById($id){

        return self::find($id);
    }

//    public function recursoAlimentacao(){
//         return $this->hasMany(PeriodoRecurso::class,'recurso_id');
//    }

//    public function recursoAlimentacao(){
//         return $this->belongsTo(Orcamento::class,'recurso_id');
//    }
}
