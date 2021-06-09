<?php

namespace IrcScheduledRoom\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';
    public    $timestamps = true;
    public    $modelName = 'Usuario';
    protected $fillable = array('name', 'email','imagem','password');


    /**
     * Carrega todos os perfis do usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userGroups(){
         return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }

    /**
     * @param Permission $permission
     * @return mixed
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles());
    }

    /**
     * @param $roles
     * @return mixed
     */

    public function hasAnyRoles($roles)
    {
        if(is_array($roles) || is_object($roles)){
            foreach($roles->get() as $r){
                return $this->roles->contains('name', $r->name);
            }
        }

        return $this->roles->contains('name', $roles);
    }


    public function syncGroups(array $groups)
    {
        if (count($groups)) {
            $result = $this->userGroups()->sync(
                Role::whereIn('name', $groups)->lists('id')->all()
            );
            return;
        }

        $this->userGroups()->detach();
    }
}