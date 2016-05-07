<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class ThrottleReply
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
        $user = Auth::user();
        $diff = $user->reply_wait_time;
        if ($diff > 0 && !$user->can('manage_topics')) {
            flash()->warning('Norint rašyti pranešimą tu turi palaukti dar '.$diff. ' sekundes.');
            return redirect()->back()->withInput();
        }

        return $next($request);
    }
}
