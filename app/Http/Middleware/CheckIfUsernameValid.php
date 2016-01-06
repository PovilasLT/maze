<?php

namespace maze\Http\Middleware;

use Closure;

use Auth;
use Validator;

class CheckIfUsernameValid
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

        if(Auth::check() && Auth::user()->name_changes == 0 && Auth::user()->created_at < new \DateTime('2016-01-06 18:00:00'))
        {

            $user = Auth::user();

            $user->update(['namechange_seen' => true]);
            $data = ['username' => $user->username];

            $validator = Validator::make($data, [
                'username' => 'required|alpha_dash'
            ]);

            if($validator->fails())
            {
                if(!$request->is('slapyvardis/*'))
                {
                    flash()->error('Tavo slapyvardis neatitinka naujų maze reikalavimų. Privalai jį pasikeisti!');
                    return redirect()->route('user.change.username');
                }
            }
            elseif(!$user->namechange_seen)
            {
                flash()->info('Tavo slapyvardis atitinka naujus maze standartus. Tačiau, esant norui, slapyvardį nemokamai gali pasikeisti '.route('user.change.username'));
            }
        }

        return $next($request);
    }
}
