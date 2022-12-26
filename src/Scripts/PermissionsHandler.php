<?php

namespace Helvetiapps\LiveControls\Scripts;

use App\Models\User;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;

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
        if(is_null($user)){
            $user = auth()->user();
        }

        return true; //DEBUG, make a check for it as soon as you add UserPermissions
    }

    public function checkGroup(UserGroup $group):bool{
        return true; //DEBUG, make a check for it as soon as you add UserPermissions
    }
}