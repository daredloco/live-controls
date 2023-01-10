<?php

namespace Helvetiapps\LiveControls\Traits\Subscriptions;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

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