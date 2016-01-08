<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class UserCanVote
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

        if($user->can_vote)
        {
            return $next($request);
        }
        else
        {
            return response('disabled');
        }
    }
}
