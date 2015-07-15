<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class CreateStatus extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(Auth::check())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'body' 				=> 'required|min:10',
		];
	}

	public function attributes()
	{
		$nice_names = [
            'body'  => 'turinys',
        ];
        return $nice_names;
	}

}
