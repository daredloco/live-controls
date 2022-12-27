<?php

namespace Helvetiapps\LiveControls\Traits\UserPermissions;

use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'user_userpermissions', 'user_id', 'user_permission_id');
    }
}