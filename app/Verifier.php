<?php

namespace maze;


use Auth;

class Verifier {

	public function verify($username, $password)
	{
		if (Auth::attempt(array('username' => $username, 'password' => $password), true))
		{
			return Auth::user()->id;
		}
		else 
		{
			return false;
		}
	}

}