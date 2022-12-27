<?php

namespace Helvetiapps\LiveControls\Traits\UserPermissions;

use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'user_userpermissions', 'user_permission_id', 'user_id');
    }
}