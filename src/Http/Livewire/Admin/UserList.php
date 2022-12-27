<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public function render()
    {
        $users = User::paginate();
        return view('livecontrols::livewire.admin.user-list', ['users' => $users]);
    }
}
