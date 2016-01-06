<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

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
		if(Auth::user()->can('manage_topics'))
		{
			$rules = [
				'title'   => 'required|min:10',
				'body'    => 'required|min:10',
				'node_id' => 'required|numeric',
				'type'	  => 'required|in:0,2,215'
	    	];
	    }
	    else
	    {
	    	$rules = [
				'title'   => 'required|min:10',
				'body'    => 'required|min:10',
				'node_id' => 'required|numeric',
				'type'	  => 'required|in:0,2'
	    	];
	    }
    	return $rules;
	}

	public function attributes()
	{
		$nice_names = [
            'title'  => 'temos pavadinimas',
            'body'  => 'temos turinys'
        ];
        return $nice_names;
	}

	public function forbiddenResponse()
    {
    	abort(403, 'Permission denied!');
    }

}
