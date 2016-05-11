<?php

namespace maze\Http\Middleware;

use Closure;
use Auth;

class IsMod
{

    private $mod_roles = [
        'Įkūrėjas',
        'Administratorius',
        'Moderatorius'
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
        if (!in_array(Auth::user()->roles()->first()->name, $this->mod_roles)) {
            flash()->error('Neleidžiamas veiksmas!');
            return redirect()->back();
        }
        return $next($request);
    }
}
