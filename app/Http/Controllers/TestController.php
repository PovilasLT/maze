<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

use Illuminate\Http\Request;

use PushNotification;

use Log;

use maze\Mention;

class TestController extends Controller {

	public function send(Request $request)
	{
		PushNotification::app('appNameAndroid')
                ->to("fEG1bsB0iO0:APA91bGS8mq1YNb6EAT335-6lHR4j3IFRon5N-tTLWdof7KIktZ8l5-id5k1-8T6JFaUNUcUJMu0iyxAqNKx8wVdhaq-EzDKGJvC3K4rDSeBR6bHrcWwE0YeT5iJtg3vtMfc2aho7YA9")
                ->send($request->input('text'));
	}

	public function show()
	{
		return view('testview');
	}
}
/**

	/api
		Bendra info apie API, link'ai i generavimasi, dokus.

	/api/app
		App generavimas
		Jei app egzistuoja, enable/disable gcm/apns
		



*/