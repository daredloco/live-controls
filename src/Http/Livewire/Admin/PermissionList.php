<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Livewire\WithPagination;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        if($this->search != ''){
            $permissions = UserPermission::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $permissions = UserPermission::paginate();
        }

        return view('livecontrols::livewire.admin.permission-list', ['permissions' => $permissions]);
    }
}
