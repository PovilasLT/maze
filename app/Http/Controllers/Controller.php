<?php namespace maze\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct() {
		if(Auth::check() && Auth::user()->is_banned)
		{
			flash()->error('Vartotojas užblokuotas.');
			Auth::logout();
		}
	}

}
