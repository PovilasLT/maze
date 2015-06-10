<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;

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
            'title'      	=> 'required|min:4|max:',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed|min:8',
            'legal'			=> 'accepted',
            'sex'           => 'boolean',
            'dob'           => 'date',
        );
		return $rules;
	}

	//Gražina custom atributų pavadinimus.
	public function attributes()
	{
		$nice_names = [
            'username'  => 'vartotojo vardas',
            'password'  => 'slaptažodis',
            'email'     => 'el-paštas',
            'legal'		=> 'taisyklėmis',
            'sex'       => 'lytis',
            'dob'       => 'gimimo data',
        ];
        return $nice_names;
	}

	public function forbiddenResponse()
    {
    	abort(403, 'Permission denied!');
    }

}
