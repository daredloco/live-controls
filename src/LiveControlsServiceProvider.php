<?php

namespace Helvetiapps\LiveControls;

use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LiveControlsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //Add Middlewares
    app('router')->aliasMiddleware('usergroup', CheckUserGroup::class);

    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livecontrols');
  }

  public function boot()
  {
    $migrationsPath = __DIR__.'/../migrations';
    $directories = glob($migrationsPath.'/*', GLOB_ONLYDIR);
    $migrationPaths = array_merge([$migrationsPath], $directories);
    $this->loadMigrationsFrom($migrationPaths);
    
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'livecontrols');

    Livewire::component('livecontrols-table', WireTable::class);

    if ($this->app->runningInConsole())
    {
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols.php'),
      ], 'config');
    }
  }
}
