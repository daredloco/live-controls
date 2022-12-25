<?php

namespace Helvetiapps\LiveControls\Http\Middleware\AdminInterface;

use Closure;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
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
    public function handle(Request $request, Closure $next, UserGroup $group)
    {
        if($group->key != config('livecontrols.usergroups_admin') && auth()->id() != config('livecontrols.admininterface_master')){
            abort(403);
        }
        return $next($request);
    }
}
