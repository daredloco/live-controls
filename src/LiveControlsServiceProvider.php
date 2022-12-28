<?php

namespace Helvetiapps\LiveControls;

use Helvetiapps\LiveControls\Console\UserGroups\AddUserGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\AddUserToGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\RemoveUserFromGroupCommand;
use Helvetiapps\LiveControls\Console\UserPermissions\RemoveUserFromPermissionCommand;
use Helvetiapps\LiveControls\Console\UserPermissions\AddUserPermissionCommand;
use Helvetiapps\LiveControls\Console\UserPermissions\AddUserToPermissionCommand;
use Helvetiapps\LiveControls\Http\Livewire\Admin\Dashboard;
use Helvetiapps\LiveControls\Http\Livewire\Admin\GroupList;
use Helvetiapps\LiveControls\Http\Livewire\Admin\Main;
use Helvetiapps\LiveControls\Http\Livewire\Admin\PermissionList;
use Helvetiapps\LiveControls\Http\Livewire\Admin\UserList;
use Helvetiapps\LiveControls\Http\Middleware\AdminInterface\CheckIsAdmin;
use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Helvetiapps\LiveControls\Http\Middleware\UserPermissions\CheckUserPermission;
use Helvetiapps\LiveControls\Models\Crypto\EncryptedModel;
use Helvetiapps\LiveControls\Scripts\PermissionsHandler;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LiveControlsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //Add Middlewares
    app('router')->aliasMiddleware('usergroup', CheckUserGroup::class);
    app('router')->aliasMiddleware('userpermission', CheckUserPermission::class);
    app('router')->aliasMiddleware('admin', CheckIsAdmin::class);

    $this->app->bind('permissionshandler', function($app){
      return new PermissionsHandler();
    });
    $this->app->bind('encryptedmodel', function($app){
      return new EncryptedModel();
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
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    //Admin Interface Components
    Livewire::component('livecontrols-admin', Main::class);
    Livewire::component('livecontrols-admin-dashboard', Dashboard::class);
    Livewire::component('livecontrols-admin-userlist', UserList::class);
    Livewire::component('livecontrols-admin-grouplist', GroupList::class);
    Livewire::component('livecontrols-admin-permissionlist', PermissionList::class);

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

      //Load Blade Components
      Blade::componentNamespace('Helvetiapps\\LiveControls\\Views\\Components', 'livecontrols');

    }

    //MACROS (Maybe used for crypto, not sure)
  }
}
