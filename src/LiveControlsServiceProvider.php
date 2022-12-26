<?php

namespace Helvetiapps\LiveControls;

use Helvetiapps\LiveControls\Facades\PermissionsHandler;
use Helvetiapps\LiveControls\Http\Middleware\AdminInterface\CheckIsAdmin;
use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Illuminate\Support\ServiceProvider;

class LiveControlsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //Add Middlewares
    app('router')->aliasMiddleware('usergroup', CheckUserGroup::class);
    app('router')->aliasMiddleware('admin', CheckIsAdmin::class);

    $this->app->bind('permissionshandler', function($app){
      return new PermissionsHandler();
    });
    
    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livecontrols');
  }

  public function boot()
  {
    $migrationsPath = __DIR__.'/../database/migrations/';
    $migrationPaths = [
      $migrationsPath.'usergroups',
      $migrationsPath.'userpermissions'
    ];

    $this->loadMigrationsFrom($migrationPaths);
    
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'livecontrols');

    //Livewire::component('livecontrols-table', WireTable::class);

    if ($this->app->runningInConsole())
    {
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols.php'),
      ], 'config');
    }
  }
}
