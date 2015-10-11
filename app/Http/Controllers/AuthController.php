<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use Illuminate\Http\Request;
use Auth, Hash;

class AuthController extends Controller {

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

	public function postLogin(Request $request)
	{
		$username = $request->input('username');
		$password = $request->input('password');

		if (Auth::attempt(array('username' => $username, 'password' => $password), true))
		{
			flash()->success('Tu sėkmingai prisijungei!');
			return redirect('/');
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
		]);

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