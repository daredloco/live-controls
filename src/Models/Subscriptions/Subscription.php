<?php

namespace Helvetiapps\LiveControls\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model{
    use HasFactory;

    protected $table = 'livecontrols_subscriptions';

    protected $fillable = [
        'name',
        'key',
        'description',
        'value_in_cents',
        'public'
    ];

    protected $casts = [
        'public' => 'boolean'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'livecontrols_user_subscriptions', 'subscription_id', 'user_id')->withPivot(['due_date', 'value_in_cents']);
    }
}