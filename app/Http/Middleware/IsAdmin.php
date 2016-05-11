<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
{

    private $admin_roles = [
        'Įkūrėjas',
        'Administratorius'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array(Auth::user()->roles()->first()->name, $this->admin_roles)) {
            flash()->error('Neleidžiamas veiksmas!');
            return redirect()->back();
        }
        return $next($request);
    }
}
