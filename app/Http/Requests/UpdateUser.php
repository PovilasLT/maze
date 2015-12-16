<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\User;

class UpdateUser extends Request {

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
			'email'		=> 'email',
			'steam'		=> 'url',
			'youtube'	=> 'url',
			'twitch'	=> 'alpha_num',
			'twitter'	=> 'alpha_dash',
			'avatar'	=> 'mimes:jpeg,png',
			'npassword' => 'confirmed|min:8',
		];
	}

}
