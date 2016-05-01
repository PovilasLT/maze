<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Topic;
use maze\TopicType;
use Auth;

class UpdateTopic extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$this->topic = Topic::findOrFail($this->route('id'));

		//patikrinam ar useris turi teise redaguoti tema.
		if(Auth::check() && (Auth::user()->id == $this->topic->user_id) || Auth::user()->can('manage_topics') )
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
		if(Auth::user()->can('manage_topics'))
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
	    }
		return $rules;
	}

	//Gražina custom atributų pavadinimus.
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
