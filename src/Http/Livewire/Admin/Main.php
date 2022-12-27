<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;

class Main extends Component
{
    public $page;

    protected $queryString = ['page' => ['as' => 'p']];

    public function mount(){
        $this->page = 'dashboard';
    }

    public function render()
    {
        $customPages = config('livecontrols.admininterface_customcontrols');
        return view('livecontrols::livewire.admin.main', ['customPages' => $customPages]);
    }

    public function changePage($page){
        $this->page = $page;
    }
}
