<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;

class AnalyticsAdmin extends Component
{
    public $page;

    protected $queryString = [
        'page' => ['as' => 'p']
    ];
   
    public function mount()
    {
        if(is_null($this->page)){
            $this->page = 'dashboard';
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.admin.analytics-admin');
    }
}
