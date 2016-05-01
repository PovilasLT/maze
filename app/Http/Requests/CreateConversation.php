<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Messenger\Conversation;

class CreateConversation extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => 'required|alpha_dash',
            'body'      => 'required'
        ];
    }

    //Gražina custom atributų pavadinimus.
    public function attributes()
    {
        $nice_names = [
            'username'  => 'gavėjo vardas',
            'body'      => 'turinys',
        ];
        return $nice_names;
    }
}
