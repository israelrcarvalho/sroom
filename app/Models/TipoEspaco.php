<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEspaco extends Model
{
    protected $table = 'tipos_espaco';
    public    $timestamps = false;
    public    $modelName = 'TipoEspaco';
    protected $fillable = array('nome');
    protected $primaryKey = 'id';



}
