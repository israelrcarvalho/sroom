<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodoRecurso extends Model
{
    protected $table = 'periodo_recurso';
    public    $timestamps = false;

    protected $fillable = array(
        'periodo_id',
        'orcamento_id',
        'quantidade',
        'unidade_id',
        'preco'
    );

    public function periodosDeste()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class,'unidade_id','id');
    }


    public function modelRecurso()
    {
        return $this->belongsTo(Orcamento::class, 'orcamento_id');
    }
//    public function recursoAlimentacao(){
//        return $this->hasMany(PeriodoRecurso::class,'recurso_id');
//    }

}
