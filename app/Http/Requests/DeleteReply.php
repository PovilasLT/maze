<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Reply;
use Auth;

class DeleteReply extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();
		$reply = Reply::findOrFail($this->input('id'));
		$this->reply = $reply;

		if($user && ($reply->user_id == $user->id || $user->can('manage_posts')))
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
			//
		];
	}

}
