<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public $search = '';

    public function render()
    {
        if($this->search != ''){
            $users = User::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $users = User::paginate();
        }

        $createRoute = config('livecontrols.routes_users')['create'] == '' ? false : config('livecontrols.routes_users')['create'];
        $editRoute = config('livecontrols.routes_users')['edit'] == '' ? false : config('livecontrols.routes_users')['edit'];
        $deleteRoute = config('livecontrols.routes_users')['delete'] == '' ? false : config('livecontrols.routes_users')['delete'];

        return view('livecontrols::livewire.admin.user-list', ['users' => $users, 'createRoute' => $createRoute, 'editRoute' => $editRoute, 'deleteRoute' => $deleteRoute]);
    }
}
