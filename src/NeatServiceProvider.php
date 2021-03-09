<?php

namespace Wantp\Neat;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Wantp\Neat\Console\GenerateCommand;
use Wantp\Neat\Console\InstallCommand;
use Wantp\Neat\Console\NeatCommand;
use Wantp\Neat\Console\PublishCommand;
use Wantp\Neat\Http\Controllers\CurrentController;
use Wantp\Neat\Http\Controllers\FileController;
use Wantp\Neat\Http\Controllers\MenuController;
use Wantp\Neat\Http\Controllers\PermissionController;
use Wantp\Neat\Http\Controllers\RoleController;
use Wantp\Neat\Http\Controllers\TokenController;
use Wantp\Neat\Http\Controllers\UserController;
use Wantp\Neat\Http\Middleware\Permission;
use Wantp\Neat\Facades\Neat;
use Wantp\Neat\Models\Role;
use Wantp\Neat\Neat as NeatAdmin;
use Wantp\Neat\Observers\RoleObserver;

class NeatServiceProvider extends ServiceProvider
{
    protected $middlewares = [
        'permission' => Permission::class
    ];

    public function register()
    {
        $this->app->singleton('neat-admin', function ($app) {
            return new NeatAdmin();
        });
        $this->app->bind(\Wantp\Neat\Contracts\Relation::class, Relation::class);

        $this->app->register(EventServiceProvider::class);
        $this->mergeConfigFrom(__DIR__ . '/../config/neat.php', 'neat');
        $this->mergeConfigFrom(__DIR__ . '/../config/neat_default.php', 'neat_default');
        JsonResource::withoutWrapping();

        $this->registerMiddleware();
    }

    public function boot()
    {
        $this->loadMigrations();
        $this->loadTranslations();
        $this->loadRoutes();
        $this->loadCommands();
        $this->loadPublishes();
        $this->observes();
    }

    protected function observes()
    {
        Role::observe(RoleObserver::class);
    }

    /**
     * Register Middleware
     */
    protected function registerMiddleware()
    {
        foreach ($this->middlewares as $name => $middleware) {
            $this->app['router']->aliasMiddleware($name, $middleware);
        }
    }

    /**
     * Load migrations
     */
    protected function loadMigrations()
    {
        if (Neat::runsMigrations()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * Load translations
     */
    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'neat');
    }

    /**
     * Load routes
     */
    protected function loadRoutes()
    {
        $routeFile = config('neat.root') . '/routes.php';
        if (is_file($routeFile)) {
            $this->loadRoutesFrom($routeFile);
            $this->defineNeatRoutes();
        }
    }

    /**
     * Defind neat admin routes
     */
    protected function defineNeatRoutes()
    {
        Route::group(['prefix' => Neat::routePrefix(), 'middleware' => ['api']], function () {
            Route::post('/tokens', [TokenController::class, 'issue']);
            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::delete('/tokens', [TokenController::class, 'delete']);
                // Current user
                Route::get('/current', [CurrentController::class, 'user']);
                Route::get('/current/menus', [CurrentController::class, 'menus']);
                Route::get('/current/permissions', [CurrentController::class, 'permissions']);
                // Neat admin files
                Route::post('/files', [FileController::class, 'store']);

                Route::group(['middleware' => ['permission']], function () {
                    // Neat admin users
                    Route::resource('/neat/users', UserController::class);
                    // Neat admin roles
                    Route::resource('/neat/roles', RoleController::class);
                    // Neat admin permissions
                    Route::put('/neat/permissions/updateOrder', [PermissionController::class, 'updateOrder']);
                    Route::get('/neat/permissions/tree', [PermissionController::class, 'tree']);
                    Route::resource('/neat/permissions', PermissionController::class);
                    // Neat admin menus
                    Route::put('/neat/menus/updateOrder', [MenuController::class, 'updateOrder']);
                    Route::get('/neat/menus/tree', [MenuController::class, 'tree']);
                    Route::resource('/neat/menus', MenuController::class);
                });
            });
        });
    }

    /**
     * Load publishes
     */
    protected function loadPublishes()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/neat.php' => config_path('neat.php'),
                __DIR__ . '/../resources/lang' => resource_path('lang'),
            ]);
        }
    }

    /**
     * Load commands
     */
    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCommand::class,
                InstallCommand::class,
                NeatCommand::class,
                PublishCommand::class,
            ]);
        }
    }

}