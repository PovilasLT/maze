<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class AdminTopic extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{

		if(Auth::check() && Auth::user()->can('manage_topics'))
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}

	public function rules() {
		return [];
	}

}
