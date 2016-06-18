<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use Auth;

class CreateSteamUser extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //patikrinti ar vartotojas yra guest arba can_create_users
        if (!Auth::check()) {
            return true;
        } else {
            $user = Auth::user();
            if ($user->can('create_users')) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = array(
            'username'      => 'required|unique:users|alpha_dash',
            'email'         => 'required|email|unique:users',
        );
        return $rules;
    }

    //Gražina custom atributų pavadinimus.
    public function attributes()
    {
        $nice_names = [
            'username'  => 'vartotojo vardas',
            'email'     => 'el-paštas',
        ];
        return $nice_names;
    }

    public function forbiddenResponse()
    {
        abort(403, 'Permission denied!');
    }
}
