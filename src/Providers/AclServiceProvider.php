<?php

namespace ConfrariaWeb\Acl\Providers;

use ConfrariaWeb\Acl\Commands\CheckPackage;
use ConfrariaWeb\Acl\Contracts\PermissionContract;
use ConfrariaWeb\Acl\Contracts\RoleContract;
use ConfrariaWeb\Acl\Repositories\PermissionRepository;
use ConfrariaWeb\Acl\Repositories\RoleRepository;
use ConfrariaWeb\Acl\Services\PermissionService;
use ConfrariaWeb\Acl\Services\RoleService;
use ConfrariaWeb\Vendor\Traits\ProviderTrait;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{

    use ProviderTrait;

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

        $this->loadViewsFrom(__DIR__ . '/../Views', 'acl');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations', 'acl');
        $this->publishes([__DIR__ . '/../../config/cw_acl.php' => config_path('cw_acl.php')], 'config');
        $this->registerSeedsFrom(__DIR__.'/../../databases/Seeds');

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
