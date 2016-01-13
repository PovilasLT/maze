<?php namespace maze\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Auth;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
		
}
