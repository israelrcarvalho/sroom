<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'users';
    public    $timestamps = true;
    public    $modelName = 'perfil';
    protected $fillable = array('password');
    protected $primaryKey = 'id';



}
