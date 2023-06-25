<?php

namespace Helvetiapps\LiveControls\Traits\UserPermissions;

use Exception;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Session;

trait HasPermissions{
    public function permissions(): BelongsToMany
    {
        if(!isset($this->permissionsTable)){
            $this->permissionsTable = 'livecontrols_user_userpermissions';
        }
        if(!isset($this->permissionsForeignColumn))
        {
            $this->permissionsForeignColumn = 'user_id';
        }
        return $this->belongsToMany(UserPermission::class, $this->permissionsTable, $this->permissionsForeignColumn, 'user_permission_id');
    }

    public function hasNotPermission(string $key): bool
    {
        foreach($this->permissions as $permission){
            if($permission->key == $key){
                return false;
            }
        }
        return true;
    }

    public function hasNotOnePermission(array $keys): bool
    {
        foreach($keys as $key){
            if($this->hasPermission($key)){
                return false;
            }
        }
        return true;
    }

    public function hasNotPermissions(array $keys): bool
    {
        foreach($keys as $key){
            if($this->hasPermission($key)){
                return false;
            }
        }
        return true;
    }

    public function hasPermission(string $key): bool
    {
        foreach($this->fetchPermissions() as $permission){
            if($permission->key == $key){
                return true;
            }
        }
        return false;
    }

    public function hasOnePermission(array $keys): bool
    {
        foreach($keys as $key){
            if($this->hasPermission($key)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissions(array $keys): bool
    {
        foreach($keys as $key){
            if(!$this->hasPermission($key)){
                return false;
            }
        }
        return true;
    }

    public function isAdmin(): bool
    {
        if($this->id == config('livecontrols.admininterface_master')){
            return true;
        }

        //Check if group is admin or is in support_groups
        if(config('livecontrols.usergroups_enabled', false)){
            foreach($this->groups as $group){
                foreach(config('livecontrols.usergroups_admins') as $adminGroup){
                    if($group->key == $adminGroup){
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function addPermissions(UserPermission|int|string ...$permissions)
    {
        foreach($permissions as $permission)
        {
            $this->addPermission($permission);
        }
    }

    public function addPermission(UserPermission|int|string $permission)
    {
        if(is_numeric($permission)){
            $permission = UserPermission::find($permission);
        }
        elseif(is_string($permission)){
            $permission = UserPermission::where('key', '=', $permission)->first();
        }
        if(is_null($permission)){
            throw new Exception('Invalid permission!');
        }
        $this->permissions()->attach($permission->id);
    }

    public function removePermissions(UserPermission|int|string ...$permissions)
    {
        foreach($permissions as $permission)
        {
            $this->removePermission($permission);
        }
    }

    public function removePermission(UserPermission|int|string $permission)
    {
        if(is_numeric($permission)){
            $permission = UserPermission::find($permission);
        }
        elseif(is_string($permission)){
            $permission = UserPermission::where('key', '=', $permission)->first();
        }
        if(is_null($permission)){
            throw new Exception('Invalid permission!');
        }
        $this->permissions()->detach($permission->id);
    }

    public function togglePermission(UserPermission|int|string $permission)
    {
        if(is_numeric($permission)){
            $permission = UserPermission::find($permission);
        }
        elseif(is_string($permission)){
            $permission = UserPermission::where('key', '=', $permission)->first();
        }
        if(is_null($permission)){
            throw new Exception('Invalid permission!');
        }
        if($this->permissions->contains($permission->id)){
            $this->permissions()->detach($permission->id);
            return;
        }
        $this->permissions()->attach($permission->id);
    }

    private function fetchPermissions() : \Illuminate\Database\Eloquent\Collection
    {
        if(isset($this->permissionsTable) && $this->permissionsTable == "livecontrols_user_userpermissions"){
            $permissions = Session::get('user_permissions', null);
            $ts = Session::get('user_permissions_timestamp', 0);
            if(is_null($permissions) || time() < $ts + (60 * 60)){
                $permissions = $this->permissions()->get();
                Session::put('user_permissions', $permissions);
                Session::put('user_permissions_timestamp', time());
            }
        }else{
            if(!isset($this->permissionsName))
            {
                throw new Exception('protected $permissionsName is not set, but is needed!');
            }
            $permissions = Session::get($this->permissionsName.'_user_permissions', null);
            $ts = Session::get($this->permissionsName.'user_permissions_timestamp', 0);
            if(is_null($permissions) || time() < $ts + (60 * 60)){
                $permissions = $this->permissions()->get();
                Session::put($this->permissionsName.'_user_permissions', $permissions);
                Session::put($this->permissionsName.'_user_permissions_timestamp', time());
            }
        }
        return $permissions;
    }
}