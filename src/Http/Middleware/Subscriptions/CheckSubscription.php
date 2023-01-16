<?php

namespace Helvetiapps\LiveControls\Http\Middleware\Subscriptions;

use Closure;
use Helvetiapps\LiveControls\Exceptions\InvalidSubscriptionException;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;
use Helvetiapps\LiveControls\Scripts\Subscriptions\SubscriptionsHandler;
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
            
            if(SubscriptionsHandler::hasSubscription(auth()->id(), $subscription, false)){
                if(SubscriptionsHandler::hasExpired(auth()->id(), $subscription)){
                    if(!is_null(config('livecontrols.subscriptions_due_route', null))){
                        return redirect()->route(config('livecontrols.subscriptions_due_route'));
                    }else{
                        abort(403);
                    }
                }
                return $next($request);
            }
        }

        
        abort(403);
    }
}
