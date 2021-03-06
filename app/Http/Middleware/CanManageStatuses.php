<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class CanManageStatuses
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
        if (!Auth::user()->can('manage_statuses')) {
            flash()->error('Neleidžiamas veiksmas!');
            return redirect()->back();
        }
        return $next($request);
    }
}
