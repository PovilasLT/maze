<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class IsPremium
{

    private $premium_roles = [
        'Įkūrėjas',
        'Administratorius',
        'Moderatorius',
        'Premium Narys'
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
        if (!in_array(Auth::user()->roles()->first()->name, $this->premium_roles)) {
            flash()->error('Neleidžiamas veiksmas!');
            return redirect()->back();
        }
        return $next($request);
    }
}
