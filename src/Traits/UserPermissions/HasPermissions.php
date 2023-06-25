<?php

namespace Helvetiapps\LiveControls\Traits\UserPermissions;

use Exception;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'livecontrols_user_userpermissions', 'user_id', 'user_permission_id');
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
        foreach($this->permissions as $permission){
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
}