<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';
    public    $timestamps = false;

    protected $fillable = array(
        'nome',
        'sigla',
        'razao_social',
        'tipo',
        'cod',
        'exibir_agendamento'
    );

    /**
     * Retorna um array com a lista de todas as unidades marcados como sim
     * usado na tela do cadastro do evento e na  tela de listagem dos eventos
     * @return array
     */
    public static function listaUnidadeGroupByTipo()
    {
        $listaDeUnidades = Unidade::orderBy('tipo', 'asc')->orderBy('nome', 'asc')->where('exibir_agendamento','1')->get();
        $arr = array();
        $i = 0;
        foreach($listaDeUnidades as $x){
            $arr[$i]['id']= $x->id;
            $arr[$i]['nome']= $x->nome;
            $arr[$i]['tipo']= $x->tipo;
            $arr[$i]['sigla'] = $x->sigla;
            $arr[$i]['razao_social'] = $x->razao_social;
            $i++;
        }

        $auxUnidades = array();

        foreach ($arr as $k => $v) {
                 $auxUnidades[iRcGetSysVal_('TIPO_UNIDADE',$v['tipo'])][$v['id']] = substr($v['nome'],0,50) ;
            if(strlen(trim($v['sigla'])) >3){
                 $auxUnidades[iRcGetSysVal_('TIPO_UNIDADE',$v['tipo'])][$v['id']] = substr($v['nome'],0,50).' ('. $v['sigla'].')' ;
            }
        }
      return  $auxUnidades;
    }

    /**
     * Retorna um array com a lista de todas as unidades não corporativas
     * usado no componente alimentação
     * @return array
     */
    public static function listaUnidadeGroupByTipoForAlimentation()
    {
        $listaDeUnidades = Unidade::orderBy('tipo', 'asc')->orderBy('nome', 'asc')->whereNotIn('tipo',array('999'))->get();
        $arr = array();
        $i = 0;
        foreach($listaDeUnidades as $x){
            $arr[$i]['id']= $x->id;
            $arr[$i]['nome']= $x->nome;
            $arr[$i]['tipo']= $x->tipo;
            $arr[$i]['sigla'] = $x->sigla;
            $arr[$i]['razao_social'] = $x->razao_social;
            $arr[$i]['cod'] = $x->cod;
            $i++;
        }

        $auxUnidades = array();

        foreach ($arr as $k => $v) {
            $auxUnidades[iRcGetSysVal_('TIPO_UNIDADE',$v['tipo'])][$v['id']] = substr($v['nome'],0,50) ;
            if(strlen(trim($v['sigla'])) >3){
                $auxUnidades[iRcGetSysVal_('TIPO_UNIDADE',$v['tipo'])][$v['id']] = substr($v['nome'],0,50).' ('. $v['sigla'].') - ' .$v['cod'];
            }
        }
        return  $auxUnidades;
    }


    /**
     * Relacionamento com o model orçamento
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orcamentos(){
        return $this->hasMany(Orcamento::class);
    }

    public function timeSheet(){

        return $this->hasMany(TimeSheet::class);

        //return $this->hasMany('Order', 'userId')->sum('amount');

    }

}
