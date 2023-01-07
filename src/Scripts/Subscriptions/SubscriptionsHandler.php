<?php

namespace Helvetiapps\LiveControls\Scripts\Subscriptions;

use App\Models\User;
use Carbon\Carbon;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;

class SubscriptionsHandler
{
    public static function addToUser(User $user, Subscription $subscription, ?int $value_in_cents = null, Carbon $due_date = null)
    {
        $user->subscriptions()->attach($subscription->id, [
            'value_in_cents' => (is_null($value_in_cents) ? $subscription->value_in_cents : $value_in_cents), 
            'due_date' => (is_null($due_date) ? Carbon::now()->addMonths(config('livecontrols.subscriptions_default_months', 12)) : $due_date)
        ]); 
    }

    public static function updateFromUser(User $user, Subscription $subscription, ?int $value_in_cents = null, Carbon $due_date = null)
    {
        $pivots = [];
        if(!is_null($value_in_cents)){
            $pivots["value_in_cents"] = $value_in_cents;
        }
        if(!is_null($due_date)){
            $pivots["due_date"] = $due_date;
        }
        $user->subscriptions()->updateExistingPivot($subscription->id, $pivots);
    }

    public static function removeFromUser(User $user, Subscription $subscription)
    {
        $user->subscriptions()->detach($subscription->id);
    }

    public static function hasExpired(User $user, Subscription $subscription): bool|null
    {
        $subscription = $user->subscriptions->find($subscription->id);
        if(is_null($subscription)){
            return null;
        }

        return $subscription->pivot->due_date->isPast();
    }

    public static function hasSubscription(User $user, Subscription $subscription, bool $withExpired = false): bool
    {
        if(!$user->subscriptions->exists($subscription->id))
        {
            return false;
        }
        if(!$withExpired)
        {
            if(static::hasExpired($user, $subscription)){
                return false;
            }
        }

        return true;
    }
}