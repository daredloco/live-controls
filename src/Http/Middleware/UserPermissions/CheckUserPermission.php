<?php

namespace Helvetiapps\LiveControls\Http\Middleware\UserPermissions;

use Closure;
use Helvetiapps\LiveControls\Exceptions\InvalidUserPermissionException;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
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
        }

        abort(403);
    }
}
