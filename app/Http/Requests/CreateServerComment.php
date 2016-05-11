<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\GameServer;
use Auth;

class CreateServerComment extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $server = GameServer::findOrFail($this->route('id'));
        $this->gameserver = $server;
        if(!$server->is_blocked)
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
            'body' => 'required|min:10',
            'server_id' => 'required|exists:servers,id'
        ];
    }
}
