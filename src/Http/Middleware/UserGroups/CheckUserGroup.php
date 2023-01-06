<?php

namespace Helvetiapps\LiveControls\Http\Middleware\UserGroups;

use Closure;
use Helvetiapps\LiveControls\Exceptions\InvalidUserGroupException;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Http\Request;

class CheckUserGroup
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
        if(!config('livecontrols.usergroups_enabled', false)){
            return $next($request);
        }
        
        foreach($keys as $key){
            $group = UserGroup::where('key', '=', $key)->first();
            if(is_null($group)){
                throw new InvalidUserGroupException($key);
            }
            
            if($group->users()->where('user_id', '=', auth()->id())->exists()){
                return $next($request);
            }
        }

        abort(403);
        
    }
}
