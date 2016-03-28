<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Node;
use Auth;

class CreateNode extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $nodeid = $this->input('parent_node');
        $this->parentNode = Node::find($nodeid);
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
            'name' => 'required|min:10',
            'description'   => 'required|min:10',
        ];
    }


    public function attributes()
    {
        $nice_names = [
            'name'  => 'skilties pavadinimas',
            'description'  => 'skilties aprašymas',
        ];
        return $nice_names;
    }

    public function forbiddenResponse()
    {
        abort(403, 'Permission denied!');
    }
}
