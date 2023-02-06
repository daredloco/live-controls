<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Exception;
use Livewire\Component;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Helvetiapps\LiveControls\Traits\SweetAlert\HasPopups;
use Livewire\WithPagination;

class SubscriptionList extends Component
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
            $subscriptions = Subscription::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $subscriptions = Subscription::paginate();
        }

        $permissions = UserPermission::orderBy('name')->get();

        return view('livecontrols::livewire.admin.subscription-list', ['subscriptions' => $subscriptions, 'permissions' => $permissions]);
    }

    public function editPermissions($id){
        $this->itemToEdit = Subscription::find($id);
        if(is_null($this->itemToEdit)){
            throw new Exception('Invalid Subscription with ID '.$id);
        }
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
