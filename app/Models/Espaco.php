<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Espaco extends Model
{
    protected $table = 'espacos';
    public $timestamps = true;
    public $modelName = 'Espaco';


    protected $fillable = array(
        'espaco_tipo',
        'nome',
        'local',
        'cod', 'cor',
        'capacidade',
        'cadastrado_por',
        'ativa'
    );

    public function tipo()
    {
        return $this->belongsTo('IrcScheduledRoom\Models\TipoEspaco', 'espaco_tipo');
    }


    public function recursos()
    {
        return $this->belongsToMany('IrcScheduledRoom\Models\Recurso', 'espaco_recurso');
    }

    public function eventos()
    {
        return $this->belongsToMany('IrcScheduledRoom\Models\Evento', 'evento_espaco');
    }

    public function syncRecursos(array $recursos)
    {

        Recurso::addNeededRecursos($recursos);

        if (count($recursos)) {
            $result = $this->recursos()->sync(
                Recurso::whereIn('nome', $recursos)->lists('id')->all()
            );
            return;
        }

        $this->recursos()->detach();
    }

    public static function addNeededEspacos(array $espacos)
    {
        if (count($espacos) === 0) {
            return;
        }

        $found = static::whereIn('nome', $espacos)->lists('nome')->all();

        foreach (array_diff($espacos, $found) as $espaco) {
            static::create([
                'espaco_tipo' => $espaco,
                'nome' => $espaco,
                'local' => $espaco,
                'cod' => $espaco,
                'capacidade' => $espaco,
                'cadastrado_por' => $espaco,
                'ativa' => $espaco,
                'cor' => $espaco,
                'created_at' => $espaco,
                'updated_at' => $espaco
            ]);
        }
    }


    public static function listEspacoGroupByLocalDisponivel()
    {

        $sub = DB::raw("id NOT IN (SELECT espaco_id FROM evento_periodo WHERE DATE(dt_realizacao) = '2016-03-21' AND ( (hora_inicio <= '10:00' AND  hora_fim >= '10:00' ) OR (hora_inicio <= '11:00' AND  hora_fim >='11:00')))");
        $listaSalas = DB::table('espacos')
            ->select('id', 'nome', 'local')
            ->where('ativa', '=', '1')
            ->whereRaw($sub)->get();

        $auxCont = 0;
        $auxArrSal = array();

        foreach ($listaSalas as $y) {
            $auxArrSal[$auxCont]['id'] = $y->id;
            $auxArrSal[$auxCont]['nome'] = $y->nome;
            $auxArrSal[$auxCont]['local'] = $y->local;
            $auxCont++;
        }
        $auxNovaListaSalas = array();
        foreach ($auxArrSal as $k => $v) {
            $auxNovaListaSalas[$v['local']][$v['id']] = $v['nome'];
        }

   return array_merge(array('' => '- Espaços -'), $auxNovaListaSalas);
    //        return Response::json(array_merge(array('' => '- Espaços -'), $auxNovaListaSalas));

    }

    public function testeajax($data,$horaInicio,$horaFim,$idEspacoAtual)
    {
        try{

        $sub = DB::raw("id NOT IN (SELECT espaco_id FROM evento_periodo
                        WHERE DATE(dt_realizacao) = '$data'
                        AND ( (hora_inicio <= '$horaInicio' AND  hora_fim >= '$horaInicio' )
                        OR (hora_inicio <= '$horaFim' AND  hora_fim >='$horaFim')) AND espaco_id IS NOT NULL AND STATUS NOT IN(1,2,3,6)) OR id = $idEspacoAtual");

        $listaSalas = DB::table('espacos')
            ->select('id', 'nome', 'local')
            ->where('ativa', '=', '1')
            ->whereRaw($sub)->orderBy('nome','asc')
            ->get();
        $auxCont = 0;
        $auxArrSal = array();

        foreach ($listaSalas as $y) {
            $auxArrSal[$auxCont]['id'] = $y->id;
            $auxArrSal[$auxCont]['nome'] = $y->nome;
            $auxArrSal[$auxCont]['local'] = $y->local;
            $auxCont++;
        }

        $auxNovaListaSalas = array();
        foreach ($auxArrSal as $k => $v) {
          //   $auxNovaListaSalas[$v['local']][$v['id']] = $v['nome'];
            $auxNovaListaSalas[$v['local']][] = ['id'=>$v['id'],'nome'=>$v['nome']];
           //  [$v['id']] = $v['nome'];
        }


        return $auxNovaListaSalas;

        } catch (\Illuminate\Database\QueryException $e) {
            echo $e->getSql();
        }
    }

    public static function listEspacoGroupByLocal()
    {

        $listaSalas = Espaco::all();

        $auxCont = 0;
        $auxArrSal = array();

        foreach ($listaSalas as $y) {

            $auxArrSal[$auxCont]['id'] = $y['id'];
            $auxArrSal[$auxCont]['nome'] = $y['nome'];
            $auxArrSal[$auxCont]['local'] = $y['local'];
            $auxCont++;
        }

        $auxNovaListaSalas = array();

        foreach ($auxArrSal as $k => $v) {
            $auxNovaListaSalas[$v['local']][$v['id']] = $v['nome'];
        }

        //return array_merge(array('0' => '- Espaços -'), $auxNovaListaSalas);
        return $auxNovaListaSalas;

    }

}
