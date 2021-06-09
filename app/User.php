<?php

namespace IrcScheduledRoom;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use IrcScheduledRoom\Models\Permission;
use IrcScheduledRoom\Models\Role;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function roles(){

        return $this->belongsToMany(Role::class);

    }

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

        // echo $roles->intersect($this->roles);
        //exit;
        if(is_array($roles) || is_object($roles)){
            //   return !! $roles->intersect($this->roles)->count();
            foreach($roles->get() as $r){

                return $this->roles->contains('name', $r->name);
                //     return $this->hasAnyRoles($r);
            }
        }

        return $this->roles->contains('name', $roles);
    }
}
