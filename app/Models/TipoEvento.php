<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    protected $table = 'tipo_eventos';
    public    $timestamps = false;

    protected $fillable = array(
        'nome',
        'descricao'
    );

}
