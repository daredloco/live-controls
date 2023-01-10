<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Exception;
use Helvetiapps\LiveControls\Exceptions\InvalidUserGroupException;
use Helvetiapps\LiveControls\Exceptions\InvalidUserPermissionException;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Helvetiapps\LiveControls\Traits\SweetAlert\HasPopups;

class UserList extends Component
{
    use HasPopups;

    public $search = '';

    public $showPermissionModal = false;
    public $showGroupModal = false;
    public $showSubscriptionsModal = false;
    public $itemToEdit = null;
    public $itemPermissions = [];
    public $itemGroups = [];
    public $itemSubscriptions = [];

    public function render()
    {
        if($this->search != ''){
            $users = User::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $users = User::paginate();
        }

        $permissions = UserPermission::orderBy('name')->get();
        $groups = UserGroup::orderBy('name')->get();
        $subscriptions = Subscription::orderBy('name')->get();
        $createRoute = config('livecontrols.routes_users')['create'] == '' ? false : config('livecontrols.routes_users')['create'];
        $editRoute = config('livecontrols.routes_users')['edit'] == '' ? false : config('livecontrols.routes_users')['edit'];
        $deleteRoute = config('livecontrols.routes_users')['delete'] == '' ? false : config('livecontrols.routes_users')['delete'];

        return view('livecontrols::livewire.admin.user-list', ['users' => $users, 'subscriptions' => $subscriptions, 'permissions' => $permissions, 'groups' => $groups, 'createRoute' => $createRoute, 'editRoute' => $editRoute, 'deleteRoute' => $deleteRoute]);
    }

    public function editPermissions($id){
        $this->itemToEdit = User::find($id);
        if(is_null($this->itemToEdit)){
            throw new Exception('Invalid User with ID '.$id);
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

    public function editGroups($id){
        $this->itemToEdit = User::find($id);
        if(is_null($this->itemToEdit)){
            throw new Exception('Invalid User with ID '.$id);
        }
        $this->itemGroups = [];
        foreach($this->itemToEdit->groups as $group){
            array_push($this->itemGroups, $group->id);
        }
        $this->showGroupModal = true;
    }

    public function updateGroup($id){
        if($this->itemToEdit->groups->contains($id)){
            $this->itemToEdit->groups()->detach($id);
            $this->popup(['type' => 'success', 'message' => __('livecontrols.admin.user_removed_from_group')]);
            return;
        }
        $this->itemToEdit->groups()->attach($id);
        $this->popup(['type' => 'success', 'message' => __('livecontrols::admin.user_added_to_group')]);
    }

    public function editSubscriptions($id){
        $this->itemToEdit = User::find($id);
        if(is_null($this->itemToEdit)){
            throw new Exception('Invalid User with ID '.$id);
        }
        $this->itemSubscriptions = [];
        foreach($this->itemToEdit->subscriptions as $subscription){
            array_push($this->itemSubscriptions, $subscription->id);
        }
        $this->showSubscriptionsModal = true;
    }

    public function updateSubscription($id){
        if($this->itemToEdit->subscriptions->contains($id)){
            $this->itemToEdit->subscriptions()->detach($id);
            $this->popup(['type' => 'success', 'message' => __('livecontrols::admin.subscription_removed')]);
            return;
        }
        $this->itemToEdit->subscriptions()->attach($id);
        $this->popup(['type' => 'success', 'message' => __('livecontrols::admin.subscription_added')]);
    }
}
