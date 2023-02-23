<?php

namespace Helvetiapps\LiveControls\Http\Middleware\Banning;

use Closure;
use Illuminate\Http\Request;

class BanCheck
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
        if(!config('livecontrols.banning_enabled', false)){
            return $next($request);
        }

        if(auth()->user()->isBanned()){
            abort(403, __('You are banned!'));
        }

        return $next($request);
    }
}
