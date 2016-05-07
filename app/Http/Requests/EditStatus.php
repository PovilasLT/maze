<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Status;
use Auth;

class EditStatus extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $status = Status::findOrFail($this->route('id'));
        if ((Auth::user()->id == $status->user_id) || Auth::user()->can('manage_statuses')) {
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
            //
        ];
    }
}
