<?php

namespace Helvetiapps\LiveControls;

use Helvetiapps\LiveControls\Console\UserGroups\AddUserGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\AddUserToGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\RemoveUserFromGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\RemoveUserFromPermissionCommand;
use Helvetiapps\LiveControls\Console\UserPermissions\AddUserPermissionCommand;
use Helvetiapps\LiveControls\Console\UserPermissions\AddUserToPermissionCommand;
use Helvetiapps\LiveControls\Facades\PermissionsHandler;
use Helvetiapps\LiveControls\Http\Middleware\AdminInterface\CheckIsAdmin;
use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Illuminate\Database\Schema\Blueprint;
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
      $this->commands([
        //User Group Commands
        AddUserGroupCommand::class,
        AddUserToGroupCommand::class,
        RemoveUserFromGroupCommand::class,

        //User Permission Commands
        AddUserPermissionCommand::class,
        AddUserToPermissionCommand::class,
        RemoveUserFromPermissionCommand::class
      ]);
      
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols.php'),
      ], 'livecontrols-config');
    }

    //MACROS (Maybe used for crypto, not sure)
  }
}
