<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\GameServer;

class AdminServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check() && Auth::user()->can('manage_servers'))
        {
            $this->gameserver = GameServer::where('slug', $this->route('slug'))->firstOrFail();
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
