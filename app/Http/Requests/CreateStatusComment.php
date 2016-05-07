<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Status;
use Auth;

class CreateStatusComment extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $status = Status::findOrFail($this->input('status_id'));

        if (Auth::check()) {
            return true;
        } else {
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
            'status_id'    => 'required|exists:statuses,id',
            'body'        => 'required|min:10'
        ];
    }

    public function attributes()
    {
        $nice_names = [
            'status_id'    => 'būsenos atnaujinimas',
            'body'        => 'turinys',
        ];
        return $nice_names;
    }
}
