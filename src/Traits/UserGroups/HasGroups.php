<?php

namespace Helvetiapps\LiveControls\Traits\UserGroups;

use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasGroups{
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'user_usergroups', 'user_group_id', 'user_id');
    }
}