<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $table = 'timesheet';
    public    $timestamps = false;

    protected $fillable = array(
        'unidade_id',
        'nome',
        'quant_nivel',
        'nivel',
        'esforco'
    );


    public function unidade()
    {
        return $this->belongsTo(Unidade::class);


    }


}