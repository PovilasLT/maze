<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\ServerComment;
use Auth;

class DeleteServerComment extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = ServerComment::findOrFail($this->route('id'));
        $this->comment = $comment;
        $user = Auth::user();
        if($user && (($comment->user_id == $user->id && !$comment->server->is_blocked) || $user->can('manage_posts')))
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
