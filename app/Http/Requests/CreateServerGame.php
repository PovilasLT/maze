<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class CreateServerGame extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check() && Auth::user()->can('manage_nodes'))
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
            'name'          => 'required|min:4',
            'style_label'   => 'required',
            'default_logo'  => 'required'
        ];
    }

    public function attributes() {
        return [
            'name'          => 'Pavadinimas',
            'style_label'   => 'Stiliaus etiketė',
            'default_logo'  => 'Logotipas'
        ];
    }
}
