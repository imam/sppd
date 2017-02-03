<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class InstallationMiddleware
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
        if(!User::first()){
            return redirect('/install');
        }
        return $next($request);
    }
}
