<?php

namespace Helvetiapps\LiveControls\Http\Middleware\UserPermissions;

use Closure;
use Helvetiapps\LiveControls\Exceptions\InvalidUserPermissionException;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Helvetiapps\LiveControls\Scripts\Subscriptions\SubscriptionsHandler;
use Illuminate\Http\Request;

class CheckUserPermission
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
        if(!config('livecontrols.userpermissions_enabled', false)){
            return $next($request);
        }

        foreach($keys as $key){
            $permission = UserPermission::where('key', '=', $key)->first();
            if(is_null($permission)){
                throw new InvalidUserPermissionException($key);
            }
            
            if($permission->users()->where('user_id', '=', auth()->id())->exists()){
                return $next($request);
            }

            
            //Check user group permissions
            if(config('livecontrols.usergroups_enabled', false)){
                if($permission->groups()->whereIn('group_id', auth()->user()->groups()->get()->toArray())->count() > 0){
                    return $next($request);
                }
            }

            //Check subscriptions permissions
            if(config('livecontrols.subscriptions_enabled', false)){
                if($permission->subscriptions()->where('subscription_id', auth()->user()->subscriptions()->get()->toArray())->count() > 0){
                    foreach($permission->subscriptions()->where('subscription_id', auth()->user()->subscriptions()->get()->toArray())->get() as $subscription)
                    {
                        if(SubscriptionsHandler::hasExpired(auth()->id(), $subscription)){
                            if(!is_null(config('livecontrols.subscriptions_due_route', null))){
                                return redirect()->route(config('livecontrols.subscriptions_due_route'));
                            }else{
                                abort(403);
                            }
                        }
                    }
                    return $next($request);
                }
            }
        }

        abort(403);
    }
}
