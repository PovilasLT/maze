<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\LoginRequest;
use maze\Http\Requests\CreateSteamUser;
use maze\Events\UserWasCreated;
use Illuminate\Http\Request;
use Auth;
use Hash;
use maze\User;
use maze\Role;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Invisnik\LaravelSteamAuth\SteamAuth;
use Cache;
use Carbon\Carbon;

class AuthController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/';
    protected $subject = 'Maze - Slaptažodžio Priminimas';
    private $steam;

    public function __construct(SteamAuth $steam)
    {
        $this->middleware('guest', [
            'only' =>
                [
                'register',
                'login'
                ]
            ]);
        $this->middleware('auth', ['only' => 'logout']);
        $this->steam = $steam;
    }

    //Registracijos puslapis
    public function register()
    {
        return view('auth.register');
    }

    //Prisijungimo puslapis
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $referrer = $request->input('ref');
        
        if (Auth::attempt(array('username' => $username, 'password' => $password), true)) {
            if (Auth::user()->type == 'steam') {
                Auth::logout();
                flash()->error('Blogas vartotojo vardas arba slaptažodis!');
                return view('auth.login');
            }

            if (session()->has('intended_url')) {
                return redirect($request->session()->pull('intended_url', '/'));
            } else {
                return redirect($referrer);
            }
        } else {
            flash()->error('Blogas vartotojo vardas arba slaptažodis!');
            return view('auth.login');
        }
    }

    public function postRegister(CreateUser $request)
    {
        $user = User::create([
            'username'        => $request->input('username'),
            'email'            => $request->input('email'),
            'password'        => Hash::make($request->input('password'))
        ]);
        $user->secret = $this->generateSecret($user->id);
        $user->attachRole(Role::where('name', '=', 'Narys')->get()->first());
        $user->save();

        event(new UserWasCreated($user));

        Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')], true);

        flash()->success('Tu sėkmingai užsiregistravai!');
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        flash()->success('Tu sėkmingai atsijungei!');
        return redirect('/');
    }

    private function generateSecret($id)
    {
        $secret = str_random(50).$id;
        while (User::where('secret', $secret)->count()) {
            $secret = str_random(50).$id;
        }
        return $secret;
    }

    public function steamLogin()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();

            if (!is_null($info)) {
                $user = User::where('steam', $info->getSteamID64())->first();

                if (is_null($user)) {
                    if (!Cache::has('steam_' . $info->getSteamID64())) {
                        Cache::put('steam_' . $info->getSteamID64(), $info, Carbon::now()->addMinutes(5));
                    }

                    return view('auth.steam', ['info' => $info]);
                }

                Auth::login($user, true);
                return redirect('/');
            }
        }

        return $this->steam->redirect();
    }

    public function postSteamLogin(CreateSteamUser $request)
    {
        if (!Cache::has('steam_' . $request->input('steamid'))) {
            return abort(404);
        }

        $info = Cache::get('steam_' . $request->input('steamid'));

        $user = User::create([
            'username'  => $request->input('username'),
            'email'     => $request->input('email'),
            'steam'     => $info->getSteamID64(),
        ]);
        $user->type = 'steam';
        $user->secret = $this->generateSecret($user->id);
        $user->attachRole(Role::where('name', '=', 'Narys')->get()->first());
        $user->save();

        event(new UserWasCreated($user));

        Auth::login($user, true);

        if (Cache::has('steam_' . $request->input('steamid'))) {
            Cache::forget('steam_' . $request->input('steamid'));
        }

        flash()->success('Tu sėkmingai prisijungei per Steam!');
        return redirect('/');
    }
}
