<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\User;

class UpdateUserSettings extends Request {

	private $gif_role_ids = [1, 2, 3, 4];

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{

		$rules = [
			'email'		=> 'email',
			'steam'		=> 'url',
			'youtube'	=> 'url',
			'twitch'	=> 'alpha_num',
			'twitter'	=> 'alpha_dash',
			'avatar'	=> 'mimes:jpeg,png'
		];

		// Modifikuojam vartotojui leidžiamus avatarus, jeigu jam galima naudoti GIF'us.
		$role_id = Auth::user()->role_id;
		if(in_array($role_id, $this->gif_role_ids)) $rules['avatar'] = 'mimes:jpeg,png,gif';

		return $rules;
	}

	public function attributes()
	{
		$nice_names = [
			'email'		 => 'el-paštas',
			'steam'		 => 'steam',
			'youtube'	 => 'youtube',
			'twitch'	 => 'twitch',
			'twitter'	 => 'twitter',
			'avatar'	 => 'avataras',
        ];
        return $nice_names;
	}

}
