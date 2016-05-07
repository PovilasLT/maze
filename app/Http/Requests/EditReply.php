<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Reply;
use Auth;

class EditReply extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            $reply = Reply::findOrFail($this->route('id'));
            $user = Auth::user();
            if (($reply->user_id == $user->id && !$reply->topic->is_blocked) || $user->can('manage_posts')) {
                return true;
            } else {
                return false;
            }
        } else {
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
