<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class AdminOnlineMiddleware
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
        if(Auth::guard('admin')->check()) {
            $expiresAt = Carbon::now()->addMinutes(3);
            Cache::put('user-is-online-' . Auth::guard('admin')->user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
