<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

use maze\TopicType;

class CreateTopic extends Request {

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
		$user = Auth::user();
		if($user->can('manage_topics'))
		{
			$rules = [
				'title'   => 'required|min:10',
				'body'    => 'required|min:10',
				'node_id' => 'required|numeric',
				'type_id' => 'required|in:'.TopicType::get()->implode('id', ',')
	    	];
	    }
	    else
	    {
	    	$rules = [
				'title'   => 'required|min:10',
				'body'    => 'required|min:10',
				'node_id' => 'required|numeric',
				'type_id' => 'required|in:'.TopicType::where('is_admin', '=', '0')->get()->implode('id', ',')
	    	];
	    	if($user->topic_count < 10)
	    	{
	    		$rules['g-recaptcha-response'] = 'required|recaptcha';
	    	}
	    }
    	return $rules;
	}

	public function attributes()
	{
		$nice_names = [
            'title'  => 'temos pavadinimas',
            'body'  => 'temos turinys',
            'type_id'	=> 'temos tipas'
        ];
        return $nice_names;
	}

	public function forbiddenResponse()
    {
    	abort(403, 'Permission denied!');
    }

}
