<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Arr;
use Modules\Admin\Entities\AdminPermission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        try {
            if (Schema::hasTable('admin_permissions')) {
                // Dynamically register permissions with Laravel's Gate.
                foreach ($this->getPermissions() as $permission) {
                    $gate->define($permission->name, function ($user) use ($permission) {
                        return $user->hasPermission($permission);
                    });
                }
            }
        } catch (QueryException $ex) {
            return;
        }
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        $keyCache = 'admin.cache.permissions';
        return cache()->rememberForever($keyCache, function () {
            return AdminPermission::with('roles')->get();
        });

    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->loadAdminAuthConfig();
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        $configModule = module_path ('Admin','Config/config.php');
        $arrayConfig = include($configModule);
        config(Arr::dot($arrayConfig['auth'], 'auth.'));
    }
}
