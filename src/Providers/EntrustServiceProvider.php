<?php

namespace ConfrariaWeb\Entrust\Providers;

use Collective\Html\FormFacade as Form;
use ConfrariaWeb\Entrust\Commands\CheckPackage;
use ConfrariaWeb\Entrust\Contracts\PermissionContract;
use ConfrariaWeb\Entrust\Contracts\RoleContract;
use ConfrariaWeb\Entrust\Repositories\PermissionRepository;
use ConfrariaWeb\Entrust\Repositories\RoleRepository;
use ConfrariaWeb\Entrust\Services\PermissionService;
use ConfrariaWeb\Entrust\Services\RoleService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class EntrustServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckPackage::class
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../Views', 'entrust');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations', 'entrust');
        $this->publishes([__DIR__ . '/../../config/cw_entrust.php' => config_path('cw_entrust.php')], 'cw_entrust');

        Form::component('roleform', 'entrust::components.role_form', ['name' => 'role', 'value' => [], 'attributes' => []]);
        Form::component('permissionform', 'entrust::components.permission_form', ['name' => 'permission', 'value' => [], 'attributes' => []]);

        Blade::directive('role', function($expression) {
            return "<?php if(auth()->user()->hasRole({$expression})) : ?>";
        });

        Blade::directive('endrole', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function($expression) {
            return "<?php if(auth()->user()->hasPermission({$expression})) : ?>";
        });

        Blade::directive('endpermission', function() {
            return "<?php endif; ?>";
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleContract::class, RoleRepository::class);
        $this->app->bind('RoleService', function ($app) {
            return new RoleService($app->make(RoleContract::class));
        });

        $this->app->bind(PermissionContract::class, PermissionRepository::class);
        $this->app->bind('PermissionService', function ($app) {
            return new PermissionService($app->make(PermissionContract::class));
        });

    }

}
