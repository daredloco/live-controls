<?php

namespace Helvetiapps\LiveControls\Scripts;

use App\Models\User;
use Exception;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Helvetiapps\LiveControls\Traits\UserGroups\HasGroups;

class PermissionsHandler{
    private array $permissions = [];

    public function add(string ...$permissions){
        array_push($this->permissions, $permissions);

        return $this;
    }

    public function addArray(array $permissions){
        array_push($this->permissions, $permissions);

        return $this;
    }

    public function remove(string $permission){
        $updatedPermissions = [];
        foreach($this->permissions as $setPermission){
            if($setPermission != $permission){
                array_push($updatedPermissions, $permission);
            }
        }
        $this->permissions = $updatedPermissions;
        return $this;
    }

    public function clear(){
        $this->permissions = [];
        return $this;
    }

    public function check(User $user = null):bool{

        if(!in_array(HasGroups::class, class_uses_recursive(User::class))){
            throw new Exception('HasGroups trait is missing in User class!');
        }

        if(is_null($user)){
            $user = auth()->user();
        }

        $groups = $user->groups;
        $subscriptions = $user->subscriptions;

        foreach($this->permissions as $permission){
            $perm = UserPermission::where('key', '=', $permission)->first();
            if(is_null($perm)){
                //Ignore if permission was not found
                continue;
            }
            if($perm->users()->where('users.id', '=', $user->id)->exists()){
                return true;
            }
            foreach($groups as $group){
                if($perm->groups()->where('livecontrols_user_groups.id', '=', $group->id)->exists()){
                    return true;
                }
            }
            foreach($subscriptions as $subscription){
                if($perm->subscriptions()->where('livecontrols_subscriptions.id', '=', $subscription->id)->exists()){
                    return true;
                }
            }
        }

        return false;
    }

    public function checkGroup(UserGroup $group):bool{
        foreach($this->permissions as $permission){
            $perm = UserPermission::where('key', '=', $permission)->first();
            if(is_null($perm)){
                //Ignore if permission was not found
                continue;
            }
            if($perm->groups()->where('user_groups.id', '=', $group->id)->exists()){
                return true;
            }
        }
        return false;
    }
}