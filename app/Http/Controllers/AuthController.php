<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use Auth;

class AuthController extends Controller {

	function __construct() {
		$this->middleware('guest', [
			'only' => [
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

	public function postLogin()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(array('username' => $username, 'password' => $password), true))
		{
			Flash::success('Tu sėkmingai prisijungei!');
			return redirect('/');
		}
		else
		{
			Flash::error('Blogas vartotojo vardas arba slaptažodis!');
			return redirect('/');
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}

}