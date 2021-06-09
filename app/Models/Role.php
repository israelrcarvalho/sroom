<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = array(
        'name',
        'label'
    );

    public function permissions(){

        return $this->belongsToMany(Permission::class);
        //return $this->HasMany(\App\Models\Permission::class);
    }
}
