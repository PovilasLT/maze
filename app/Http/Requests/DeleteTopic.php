<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Topic;
use Auth;

class DeleteTopic extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();
		$topic = Topic::findOrFail($this->route('id'));
		$this->topic = $topic;

		if($user && ($topic->user_id == $user->id || $user->can('manage_topics')))
		{
			return true;
		}
		else {
			return false;
		}
	}

	public function rules()
	{
		return [];
	}

}
