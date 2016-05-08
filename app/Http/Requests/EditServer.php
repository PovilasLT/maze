<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;
use maze\Server;

class EditServer extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $this->gameserver = Server::where('slug', $this->route('slug'))->firstOrFail();
        if($user && $this->gameserver && ($user->id == $this->gameserver->user->id || $user->can('manage_servers')))
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
