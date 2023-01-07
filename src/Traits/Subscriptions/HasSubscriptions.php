<?php

namespace Helvetiapps\LiveControls\Traits\Subscriptions;

use Helvetiapps\LiveControls\Models\Support\SupportTicket;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSubscriptions{
    public function subscriptions():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'livecontrols_user_subscriptions', 'user_id', 'subscription_id')->withPivot(['due_date', 'value_in_cents']);
    }

    public function getSubscriptionsValueAttribute():int
    {
        $totalValue = 0;
        foreach($this->subscriptions as $subscription){
            $totalValue += $subscription->pivot->value_in_cents;
        }
        return $totalValue;
    }
}