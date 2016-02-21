<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\User;

class UpdatePasswordSettings extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		if($user)
		{
			return true;
		}
		else {
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
			'password'  => 'required',
			'npassword' => 'confirmed|min:8',
		];
	}

	public function attributes()
	{
		$nice_names = [
			'password'   => 'slaptažodis',
            'npassword'  => 'naujas slaptažodis',
        ];
        return $nice_names;
	}

}
