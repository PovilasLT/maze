<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\ServerComment;
use Auth;

class UpdateServerComment extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $comment = ServerComment::findOrFail($this->route('id'));
            if((!$comment->server->is_blocked && $comment->user_id == $user->id) || $user->can('manage_posts'))
            {
                return true;
            }
            else
            {
                return false;
            }
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
            'body' => 'required|min:10',
            'comment_id' => 'required|exists:server_comments,id'
        ];
    }
}
