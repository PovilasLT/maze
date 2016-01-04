<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class LogIn
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
        if(!Auth::check())
        {
            flash()->error('Norėdamas(-a) atlikti šį veiksmą privalai prisijungti!');

            if($request->ajax())
            {
                return response('auth required');
            }
            else
            {
                return redirect()->route('auth.login');
            }
        }
        return $next($request);
    }
}