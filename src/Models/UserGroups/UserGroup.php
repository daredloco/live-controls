<?php

namespace Helvetiapps\LiveControls\Models\UserGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroup extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'description',
        'color'
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_usergroups', 'user_id', 'user_group_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'group_userpermissions', 'user_permission_id', 'user_group_id');
    }
}