<?php

namespace Helvetiapps\LiveControls\Models\UserPermissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserPermission extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'description'
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_userpermissions', 'user_id', 'user_permission_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'group_userpermissions', 'user_group_id', 'user_permission_id');
    }
}