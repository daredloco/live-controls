<?php

namespace Helvetiapps\LiveControls\Http\Middleware\AdminInterface;

use Closure;
use Helvetiapps\LiveControls\Scripts\Analytics\UserRequest;
use Illuminate\Http\Request;

class Analyzer
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
        if(config('livecontrols.analytics_enabled', false)){
            UserRequest::create($request);
        }
        return $next($request);
    }
}
