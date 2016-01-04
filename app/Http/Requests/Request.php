<?php namespace maze\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {

	public function forbiddenResponse()
	{
		dd('yo');
		return $this->redirector->route('auth.login');
	}
}
