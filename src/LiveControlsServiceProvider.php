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
use Helvetiapps\LiveControls\Http\Livewire\Admin\SubscriptionList;
use Helvetiapps\LiveControls\Http\Livewire\Admin\UserList;
use Helvetiapps\LiveControls\Http\Livewire\AutoCEP\AutoCep;
use Helvetiapps\LiveControls\Http\Livewire\BbEditor\BbEditor;
use Helvetiapps\LiveControls\Http\Livewire\Calendar\Calendar;
use Helvetiapps\LiveControls\Http\Livewire\MaskedInput\MaskedInput;
use Helvetiapps\LiveControls\Http\Livewire\Support\MessagesHandler;
use Helvetiapps\LiveControls\Http\Livewire\Support\StatusHandler;
use Helvetiapps\LiveControls\Http\Livewire\SweetAlert\SweetAlert;
use Helvetiapps\LiveControls\Http\Middleware\AdminInterface\Analyzer;
use Helvetiapps\LiveControls\Http\Middleware\AdminInterface\CheckIsAdmin;
use Helvetiapps\LiveControls\Http\Middleware\Banning\BanCheck;
use Helvetiapps\LiveControls\Http\Middleware\Subscriptions\CheckSubscription;
use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Helvetiapps\LiveControls\Http\Middleware\UserPermissions\CheckUserPermission;
use Helvetiapps\LiveControls\Scripts\PermissionsHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
    app('router')->aliasMiddleware('subscription', CheckSubscription::class);
    app('router')->aliasMiddleware('banned', BanCheck::class);
    app('router')->aliasMiddleware('analytics', Analyzer::class);

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
      $migrationsPath.'userpermissions',
      $migrationsPath.'support',
      $migrationsPath.'subscriptions',
      $migrationsPath.'banning',
      $migrationsPath.'analytics'
    ];

    $this->loadTranslationsFrom(__DIR__.'/../lang', 'livecontrols');
    $this->loadMigrationsFrom($migrationPaths);
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'livecontrols');
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    //Admin Interface Components
    Livewire::component('livecontrols-admin', Main::class);
    Livewire::component('livecontrols-admin-dashboard', Dashboard::class);
    Livewire::component('livecontrols-admin-userlist', UserList::class);
    Livewire::component('livecontrols-admin-grouplist', GroupList::class);
    Livewire::component('livecontrols-admin-permissionlist', PermissionList::class);
    Livewire::component('livecontrols-admin-subscriptionlist', SubscriptionList::class);
    Livewire::component('livecontrols-support-messages', MessagesHandler::class);
    Livewire::component('livecontrols-support-status', StatusHandler::class);
    Livewire::component('livecontrols-sweetalert', SweetAlert::class);
    Livewire::component('livecontrols-autocep', AutoCep::class);
    Livewire::component('livecontrols-masked-input', MaskedInput::class);
    Livewire::component('livecontrols-bbeditor', BbEditor::class);
    Livewire::component('livecontrols-calendar', Calendar::class);
    
    //Load Blade Components
    // Blade::componentNamespace('Helvetiapps\\LiveControls\\Views\\Components', 'livecontrols');
    
    //MACROS
    //Add Popup Macros
    Redirector::macro('popup', function ($data) {
      return $this->with('popup', $data);
    });
    RedirectResponse::macro('popup', function ($data) {
      return $this->with('popup', $data);
    });

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

      $this->publishes([
        __DIR__.'/../lang' => resource_path('lang/vendor/livecontrols'),
      ], 'livecontrols-localization');

      $this->publishes([
        __DIR__.'/../resources/views' => resource_path('views/vendor/livecontrols'),
      ], 'livecontrols-views');
    }
  }
}
