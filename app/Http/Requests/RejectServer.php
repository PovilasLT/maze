<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\GameServer;

class RejectServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->gameserver = GameServer::where('slug', $this->route('slug'))->firstOrFail();
        if(Auth::check() && Auth::user()->can('manage_servers'))
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
            'server_id'     => 'required|exists:servers,id',
            'reason'        => 'required|min:10'
        ];
    }

    public function attributes() 
    {
        return [
            'server_id'     => 'Serveris',
            'reason'        => 'Priežastis'
        ];
    }
}
