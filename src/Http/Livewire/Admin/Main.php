<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;

class Main extends Component
{
    public $page;

    public function mount(){
        $this->page = 'dashboard';
    }

    public function render()
    {
        $customPages = config('livecontrols.admininterface_customcontrols');
        dd($customPages);
        return view('livecontrols::livewire.admin.main', ['customPages' => $customPages]);
    }

    public function changePage($page){
        $this->page = $page;
    }
}
