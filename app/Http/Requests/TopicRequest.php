<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

use maze\TopicType;

class TopicRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$topic = $this->route('topic');
		if($topic) {
			// resource owner or can manage_topics
			return ($this->user()->id == $topic->user_id) || $this->user()->can('manage_topics');
		} else {
			return true;
		}
 	}

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
