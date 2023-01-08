<?php

namespace Helvetiapps\LiveControls\Scripts\Subscriptions;

use App\Models\User;
use Carbon\Carbon;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;

class SubscriptionsHandler
{
    public static function addToUser(User $user, Subscription|string $subscription, ?int $value_in_cents = null, Carbon $due_date = null):bool
    {
        if(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $user->subscriptions()->attach($subscription->id, [
            'value_in_cents' => (is_null($value_in_cents) ? $subscription->value_in_cents : $value_in_cents), 
            'due_date' => (is_null($due_date) ? Carbon::now()->addMonths(config('livecontrols.subscriptions_default_months', 12)) : $due_date)
        ]);
        return true;
    }

    public static function updateFromUser(User $user, Subscription|string $subscription, ?int $value_in_cents = null, Carbon $due_date = null):bool
    {
        if(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $pivots = [];
        if(!is_null($value_in_cents)){
            $pivots["value_in_cents"] = $value_in_cents;
        }
        if(!is_null($due_date)){
            $pivots["due_date"] = $due_date;
        }
        $user->subscriptions()->updateExistingPivot($subscription->id, $pivots);
        return true;
    }

    public static function removeFromUser(User $user, Subscription|string $subscription): bool
    {
        if(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $user->subscriptions()->detach($subscription->id);
        return true;
    }

    public static function hasExpired(User $user, Subscription|string $subscription): bool|null
    {
        if(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $subscription = $user->subscriptions->find($subscription->id);
        if(is_null($subscription)){
            return null;
        }

        return $subscription->pivot->due_date->isPast();
    }

    public static function hasSubscription(User $user, Subscription|string $subscription, bool $withExpired = false): bool
    {
        if(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
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