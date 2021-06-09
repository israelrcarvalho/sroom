<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class EventoNivel extends Model
{
    protected $table = 'evento_nivel';
    public    $timestamps = false;
    protected $fillable = array(
        'evento_id',
        'nivel_id'
    );

    public function nivelById($id){
        return Nivel::find($id);
    }
}
