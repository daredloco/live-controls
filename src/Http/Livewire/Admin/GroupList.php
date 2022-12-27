<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;

class GroupList extends Component
{
    public $search = '';

    public $showPermissionModal = false;
    public $itemToEdit = null;
    public $itemPermissions = [];

    public function render()
    {
        if($this->search != ''){
            $groups = UserGroup::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $groups = UserGroup::paginate();
        }

        $permissions = UserPermission::orderBy('name')->get();

        return view('livecontrols::livewire.admin.group-list', ['groups' => $groups, 'permissions' => $permissions]);
    }

    public function editPermissions($id){
        $this->itemToEdit = UserGroup::find($id);
        $this->itemPermissions = [];
        foreach($this->itemToEdit->permissions as $permission){
            array_push($this->itemPermissions, $permission->id);
        }
        $this->showPermissionModal = true;
    }

    public function updatePermission($id){
        if($this->itemToEdit->permissions->contains($id)){
            $this->itemToEdit->permissions()->detach($id);
            $this->dispatchBrowserEvent('showToast', ['success', 'Permission removed!']);
            return;
        }
        $this->itemToEdit->permissions()->attach($id);
        $this->dispatchBrowserEvent('showToast', ['success', 'Permission granted!']);
    }
}
