<?php

namespace Helvetiapps\LiveControls\Traits\UserPermissions;

use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'livecontrols_user_userpermissions', 'user_id', 'user_permission_id');
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
}