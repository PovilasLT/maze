<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\StatusComment;
use Auth;

class DeleteStatusComment extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$comment_id = $this->route('id');
		$comment 	= StatusComment::findOrFail($comment_id);

		$user = Auth::user();

		$is_owner = $comment->user_id == Auth::user()->id;

		if($is_owner || $user->can('manage_comments'))
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
		return [
			//
		];
	}

}
