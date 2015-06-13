<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\Reply;
use maze\Topic;

class AnswerReply extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(Auth::check())
		{
			//if user owns the topic or if user is admin
			$reply = Reply::findOrFail($this->route('id'));
			$topic = $reply->topic;
			$this->reply = $reply;
			if(($topic->user_id == Auth::user()->id) || Auth::user()->can('manage_topics'))
			{
				return true;
			}
			else 
			{
				return false;
			}
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
			//
		];
	}

}
