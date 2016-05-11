<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\GameServer;
use Auth;

class DeleteServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $gameserver = GameServer::where('slug', $this->route('slug'))->firstOrFail();
        $this->gameserver = $gameserver;
        if($user && ($gameserver->user_id == $user->id || $user->can('manage_servers')))
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
            //
        ];
    }
}
