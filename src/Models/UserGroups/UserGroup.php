<?php

namespace Helvetiapps\LiveControls\Models\UserGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'key'
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_usergroups', 'user_id', 'user_group_id');
    }
}