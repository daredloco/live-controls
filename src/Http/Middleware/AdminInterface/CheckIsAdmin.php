<?php

namespace Helvetiapps\LiveControls\Http\Middleware\AdminInterface;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Pass if user is master
        if(auth()->id() == config('livecontrols.admininterface_master')){
            return $next($request);
        }

        if(config('livecontrols.usergroups_enabled', false)){
            foreach(auth()->user()->groups as $group){
                $groupKey = $group->key;
                //Pass if user is in admin group(s)
                if(is_array(config('livecontrols.usergroups_admins'))){
                    foreach(config('livecontrols.usergroups_admins') as $adminKey){
                        if($adminKey == $groupKey){
                            return $next($request);
                        }
                    }
                }else{
                    if($groupKey == config('livecontrols.usergroups_admins')){
                        return $next($request);
                    }
                }
            }
        }

        //Throw 403 if user is neither master nor in an admin group
        abort(403);
    }
}
