<?php

namespace IrcScheduledRoom\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use IrcScheduledRoom\Models\Permission;
use IrcScheduledRoom\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'IrcScheduledRoom\Model' => 'IrcScheduledRoom\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $p) {

            $gate->define(trim($p->name), function (User $user) use ($p) {
                return $user->hasPermission($p);
            });
        }



            // -----------------------------------------
                  $gate->before(function($user,$ability){
                      if($user->hasAnyRoles('Admin')){
                          return true;
                      }
                  });


    }
}