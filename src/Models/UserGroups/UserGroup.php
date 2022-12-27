<?php

namespace Helvetiapps\LiveControls\Models\UserGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->belongsToMany(User::class, 'user_usergroups', 'user_group_id', 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'group_userpermissions', 'user_group_id', 'user_permission_id');
    }
}