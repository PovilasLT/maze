<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Topic;
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
		$rules = array(
            'title'   => 'required|min:2',
			'body'    => 'required|min:2',
			'node_id' => 'required|numeric'
        );
		return $rules;
	}

	//Gražina custom atributų pavadinimus.
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
