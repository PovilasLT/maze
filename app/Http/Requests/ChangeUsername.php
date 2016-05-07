<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class ChangeUsername extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check() && !Auth::user()->name_changes) {
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        $rules = array(
            'username'      => 'required|unique:users|alpha_dash',
        );
        return $rules;
    }

    //Gražina custom atributų pavadinimus.
    public function attributes()
    {
        $nice_names = [
            'username'  => 'vartotojo vardas',
        ];
        return $nice_names;
    }
}
