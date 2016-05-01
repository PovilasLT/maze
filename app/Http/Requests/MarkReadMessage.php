<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class MarkReadMessage extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $conversation = $this->route('conversation');
        $message = $this->route('message');
        return $conversation->id == $message->conversation_id && $message->user_id != Auth::user()->id;
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
