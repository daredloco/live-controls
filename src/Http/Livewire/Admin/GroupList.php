<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Helvetiapps\LiveControls\Traits\SweetAlert\HasPopups;
use Livewire\WithPagination;

class GroupList extends Component
{
    use HasPopups;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
            $this->popup(['type' => 'success', 'message' => __('livecontrols::admin.permission_removed')]);
            return;
        }
        $this->itemToEdit->permissions()->attach($id);
        $this->popup(['type' => 'success', 'message' => __('livecontrols::admin.permission_granted')]);
    }
}
