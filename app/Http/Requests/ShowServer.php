<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;

use maze\GameServer;
use Auth;

class ShowServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $server = GameServer::where('slug', $this->route('slug'))->firstOrFail();
        $user = Auth::user();
        // One may ask, WHO CAN SEE THE BLOODY SERVER?
        // Jei serveris patvirtintas - visi
        // Useris sukūręs tą serverį, nesvarbu patvirtintas ar ne
        // Administracija
        if($server->is_confirmed || (Auth::check() && ($user->can('manage_servers') || $server->user->id == $user->id)))
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

    public function forbiddenResponse()
    {
        abort(403, 'Permission denied!');
    }
}
