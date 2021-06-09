<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Periodo extends Model
{
    protected $table = 'evento_periodo';
    public $timestamps = true;

    protected $fillable = array(
        'evento_id',
        'dt_realizacao',
        'hora_inicio',
        'hora_fim',
        'espaco_id',
        'nivel_id',
        'status',
        'justificativa'
    );

    /**
     * Retorna o evento deste periodo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eventoPeriodo()
    {
        return $this->belongsTo('IrcScheduledRoom\Models\Evento', 'evento_id');
    }

    /**
     * Retorna todos os recursos deste periodo ou desta data
     * O Model PeriodoRecurso está mapeado com  a table periodo_recurso
     * O campo de ligação é periodo_id
     * @return mixed
     */
    public function modelPeriodoRecurso()
    {
         return $this->hasMany(PeriodoRecurso::class);
    }

    /**
     * Retorna todos o espaço deste periodo ou desta data
     * @return mixed
     */
    public function espaco()
    {
        return $this->belongsTo(Espaco::class, 'espaco_id');
    }

    public function nomeDoespacoPorId($id)
    {
        return Espaco::find($id);
    }

    public function valorDoNivelById($id)
    {
        return Nivel::find($id);
    }

//    public function singleNivel()
//    {
//        return $this->hasMany('IrcScheduledRoom\Models\EventoNivel', 'evento_id');
//    }
//
    public function getDtrealizacaoAttribute($dtrealizacao)
    {

        return Carbon::parse($dtrealizacao)->format('d.m.Y');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUnidadeById($id)
    {
        return Unidade::find($id);
    }


}
