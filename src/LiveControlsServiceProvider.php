<?php

namespace Helvetiapps\LiveControls;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LiveControlsServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livecontrols');
  }

  public function boot()
  {
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
