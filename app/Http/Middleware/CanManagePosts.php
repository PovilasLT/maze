<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class CanManagePosts
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
        if (!Auth::check() || !Auth::user()->can('manage_posts')) {
            flash()->error('Neleidžiamas veiksmas!');
            return redirect()->back();
        }
        return $next($request);
    }
}
