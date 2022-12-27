<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public function render()
    {
        $users = User::paginate();

        $createRoute = config('livecontrols.routes_users')['create'] == '' ? '#' : config('livecontrols.routes_users')['create'];
        $editRoute = config('livecontrols.routes_users')['edit'] == '' ? '#' : config('livecontrols.routes_users')['edit'];
        $deleteRoute = config('livecontrols.routes_users')['delete'] == '' ? '#' : config('livecontrols.routes_users')['delete'];

        dd($createRoute, $editRoute, $deleteRoute);
        
        return view('livecontrols::livewire.admin.user-list', ['users' => $users, 'createRoute' => $createRoute, 'editRoute' => $editRoute, 'deleteRoute' => $deleteRoute]);
    }
}
