<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    // public    $timestamps = false;
    public    $modelName = 'Permission';
    protected $fillable = array('name', 'label');


    public function roles(){

        return $this->belongsToMany(Role::class);
        //return $this->belongsToMany(\IrcScheduledRoom\Models\Role::class);
    }
}
