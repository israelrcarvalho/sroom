<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'orcamento';
    public    $timestamps = false;

    protected $fillable = array(
        'unidade_id',
        'centro_id',
        'recurso_id',
        'ano',
        'quantidade',
        'saldo'
    );


    public function listaUnidades(){
        return Unidade::listaUnidadeGroupByTipo();

    }

    /**
     * Lista a unidade deste orçamento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidades()
    {
        return $this->belongsTo(Unidade::class, 'unidade_id');
    }

    /**
     * Lista o centro de responsabilidade deste orçamento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centros()
    {
        return $this->belongsTo(Centro::class, 'centro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recursos()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }


    public function recursoAlimentacao(){
        return $this->hasMany(PeriodoRecurso::class,'orcamento_id');
    }


    public function getAno(){

        return $ano = array(
                    '2016' =>'2016',
                    '2017' =>'2017',
                    '2018' =>'2018',
                    '2019' =>'2019',
                    '2020' =>'2020',
                    '2021' =>'2021',
                    '2022' =>'2022'
                );
    }



}