<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Auth, Hash;
use maze\User;
use maze\Role;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthController extends Controller {

    use ResetsPasswords;

    protected $redirectTo = '/';
    protected $subject = 'Maze - Slaptažodžio Priminimas';

	function __construct() {
		$this->middleware('guest', [
			'only' => 
				[
				'register',
				'login'
				]
			]);
		$this->middleware('auth', ['only' => 'logout']);
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

		if (Auth::attempt(array('username' => $username, 'password' => $password), true))
		{
			return redirect($request->session()->pull('intended_url', '/'));
		}
		else
		{
			flash()->error('Blogas vartotojo vardas arba slaptažodis!');
			return view('auth.login');
		}
	}

	public function postRegister(CreateUser $request)
	{
		User::create([
			'username'		=> $request->input('username'),
			'email'			=> $request->input('email'),
			'password'		=> Hash::make($request->input('password'))
		])
		->attachRole(Role::where('name', '=', 'Narys')->get()->first());

		flash()->success('Tu sėkmingai užsiregistravai! Dabar gali prisijungti!');
		return redirect('/');
	}

	public function logout()
	{
		Auth::logout();
		flash()->success('Tu sėkmingai atsijungei!');
		return redirect('/');
	}

}