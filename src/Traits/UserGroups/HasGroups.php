<?php

namespace Helvetiapps\LiveControls\Traits\UserGroups;

use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasGroups{
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'livecontrols_user_usergroups', 'user_id', 'user_group_id');
    }
}