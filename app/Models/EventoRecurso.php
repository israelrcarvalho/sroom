<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class EventoRecurso extends Model
{
    protected $table = 'evento_recurso';
    public    $timestamps = true;
    // public    $modelName = 'EventoRecurso';
    protected $fillable = array(
        'evento_id',
        'recurso_id'
    );


    public function recursoById($id){
        return Recurso::find($id);
    }

}
