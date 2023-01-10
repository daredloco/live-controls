<?php

namespace Helvetiapps\LiveControls\Http\Middleware\Subscriptions;

use Closure;
use Helvetiapps\LiveControls\Exceptions\InvalidSubscriptionException;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;
use Illuminate\Http\Request;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string ...$keys)
    {
        if(!config('livecontrols.subscriptions_enabled', false)){
            return $next($request);
        }

        foreach($keys as $key){
            $subscription = Subscription::where('key', '=', $key)->first();
            if(is_null($subscription)){
                throw new InvalidSubscriptionException($key);
            }
            
            if($subscription->users()->where('user_id', '=', auth()->id())->exists()){
                return $next($request);
            }
        }

        abort(403);
    }
}
