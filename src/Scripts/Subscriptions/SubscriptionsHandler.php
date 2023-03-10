<?php

namespace Helvetiapps\LiveControls\Scripts\Subscriptions;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;

class SubscriptionsHandler
{
    public static function addToUser(User|int $user, Subscription|string|int $subscription, ?int $value_in_cents = null, Carbon $due_date = null):bool
    {
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            return false;
        }
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
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

    public static function updateFromUser(User|int $user, Subscription|string|int $subscription, ?int $value_in_cents = null, Carbon $due_date = null):bool
    {
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            return false;
        }
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
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

    public static function removeFromUser(User|int $user, Subscription|string|int $subscription): bool
    {
        
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            return false;
        }
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $user->subscriptions()->detach($subscription->id);
        return true;
    }

    public static function addPermission(Subscription|string|int $subscription, UserPermission|string|int $permission): bool
    {
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        if(is_numeric($permission)){
            $permission = UserPermission::find($permission);
        }
        elseif(is_string($permission)){
            $permission = UserPermission::where('key', '=', $permission)->first();
        }
        if(is_null($permission)){
            return false;
        }
        $subscription->permissions()->attach($permission->id);
        return true;
    }

    public static function removePermission(Subscription|string|int $subscription, UserPermission|string|int $permission)
    {
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        if(is_numeric($permission)){
            $permission = UserPermission::find($permission);
        }
        elseif(is_string($permission)){
            $permission = UserPermission::where('key', '=', $permission)->first();
        }
        if(is_null($permission)){
            return false;
        }
        $subscription->permissions()->detach($permission->id);
        return true;
    }

    public static function hasExpired(User|int $user, Subscription|string|int $subscription): bool|null
    {
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            return false;
        }
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
            $subscription = Subscription::where('key', '=', $subscription)->first();
        }
        if(is_null($subscription)){
            return false;
        }
        $subscription = $user->subscriptions->find($subscription->id);
        if(is_null($subscription)){
            return null;
        }

        return (new \Carbon\Carbon($subscription->pivot->due_date))->isPast();
    }

    public static function hasNotExpired(User|int $user, Subscription|string|int $subscription): bool|null
    {
        return !static::hasExpired($user, $subscription);
    }

    public static function hasSubscription(User|int $user, Subscription|string|int $subscription, bool $withExpired = false): bool
    {
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            return false;
        }
        if(is_numeric($subscription)){
            $subscription = Subscription::find($subscription);
        }
        elseif(is_string($subscription)){
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

    public static function hasNotSubscription(User|int $user, Subscription|string|int $subscription, bool $withExpired = false): bool
    {
        return !static::hasSubscription($user, $subscription, $withExpired);
    }

    public static function getExpiredSubscriptions(User|int $user):array{
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
            throw new Exception('Invalid User');
        }
        $expiredOnes = [];
        foreach($user->subscriptions as $subscription){
            if(static::hasExpired($user, $subscription)){
                array_push($expiredOnes, $subscription);
            }
        }
        return $expiredOnes;
    }
}