<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;


class Nivel extends Model
{
    protected $table = 'niveis';
    public $timestamps = true;
    public $modelName = 'nivel';


    protected $fillable = array(
        'nivel_tipo',
        'nome',
        'valor'
    );


    public static function listaNivelGroupByTipo()
    {
        $listaDeNiveis = Nivel::all()->sortBy('id');
      //  $listaDeNiveis = Nivel::orderBy('id','desc')->get();

        $arr = array();
        $i = 0;
        foreach($listaDeNiveis as $x){
            $arr[$i]['id']= $x->id;
            $arr[$i]['nome']= $x->nome;
            $arr[$i]['nivel_tipo']= $x->nivel_tipo;
            $arr[$i]['vlr_nivel'] = $x->valor;
            $i++;
        }

        $auxNiveis = array();
        foreach ($arr as $k => $v) {
            $auxNiveis[iRcGetSysVal_('TIPO_NIVEL',$v['nivel_tipo'])][$v['id']] = 'Nível: '. $v['vlr_nivel'] .' | '. substr($v['nome'], 0, 100) .'...';
        }

        return $auxNiveis ;
    }
}
