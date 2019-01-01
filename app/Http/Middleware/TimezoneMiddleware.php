<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TimezoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$timezone = Auth::user()->getSetting('timezone');
    	if (!$timezone)
    		$timezone = 'UTC';
	    date_default_timezone_set($timezone);
	    config(['app.timezone' => $timezone]);
        return $next($request);
    }
}
