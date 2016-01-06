<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Conversation;

use Auth;

class ShowConversation extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //patikrinam ar zmogus dalyvauja pokalbyje kuri bando perziureti.
        $this->conversation = Conversation::findOrFail($this->route('id'));

        if($this->conversation->users()->where('user_id', Auth::user()->id)->first())
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
