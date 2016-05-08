<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\ServerGame;

class CreateServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())
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
            'game_id' => 'required|exists:server_games,id',
            'logo'      => 'mimes:jpeg,png',
            'name'      => 'required|min:10',
            'body'      => 'required|min:10',
            'port'      => 'numeric',
            //'ip'        => 'ip',
        ];
    }

    public function attributes()
    {
        $nice_names = [
            'game_id'     => 'serverio žaidimas',
            'ip'            => 'serverio ip',
            'port'          => 'serverio port',
            'website'       => 'serverio svetainė',
            'name'          => 'serverio pavadinimas',
            'body'          => 'serverio aprašymas',
            'logo'          => 'logotipas',
        ];
        return $nice_names;
    }
}
