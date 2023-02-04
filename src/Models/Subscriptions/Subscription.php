<?php

namespace Helvetiapps\LiveControls\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model{
    use HasFactory;

    protected $table = 'livecontrols_subscriptions';

    protected $fillable = [
        'name',
        'key',
        'description',
        'value_in_cents',
        'duration_in_days',
        'public'
    ];

    protected $casts = [
        'public' => 'boolean'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'livecontrols_user_subscriptions', 'subscription_id', 'user_id')->withPivot(['due_date', 'value_in_cents']);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'livecontrols_subscription_permissions', 'subscription_id', 'user_permission_id');
    }
}