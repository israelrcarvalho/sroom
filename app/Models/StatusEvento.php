<?php

namespace IrcScheduledRoom\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StatusEvento extends Model
{
    protected $table = 'evento_status';
    public    $timestamps = false;

    public function getDataeventoAttribute($dataevento){
        if($dataevento){
             return Carbon::parse($dataevento)->format('d.m.Y');
        } else{
            return null;
        }
    }


    public function recursos()
    {
        return $this->belongsToMany(Recurso::class, 'evento_recurso');
    }


}
