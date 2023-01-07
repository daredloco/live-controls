<?php

namespace Helvetiapps\LiveControls\Traits\Support;

use Helvetiapps\LiveControls\Models\Support\SupportTicket;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSupport{
    public function subscriptions():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'livecontrols_user_subscriptions', 'user_id', 'subscription_id')->withPivot(['due_date', 'value_in_cents']);
    }
}