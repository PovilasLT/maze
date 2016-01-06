<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class CheckIfUserIsBanned
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
        if(Auth::check() && Auth::user()->is_banned)
        {
            flash()->error('Vartotojas užblokuotas.');
            Auth::logout();

            return redirect('/');
        }

        return $next($request);
    }
}
