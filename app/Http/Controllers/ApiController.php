<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

use Illuminate\Http\Request;

use PushNotification;

use Log;

use maze\Mention;

class ApiController extends Controller {

	public function register()
	{
		return view('api.register');
	}
	
}