<?php
namespace App\Providers;
use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        if (Schema::hasTable('permissions'))
        {
            foreach ($this->getPermissions() as $permission)
            {
                $gate->define($permission->name, function ($user) use ($permission)
                {
                    return $user->hasRole($permission->roles);
                });
            }
        }
    }

    protected function getPermissions()
    {
        if (Schema::hasTable('permissions'))
        {
            return Permission::with('roles')->get();
        }
    }

}