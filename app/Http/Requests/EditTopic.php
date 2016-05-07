<?php namespace maze\Http\Requests;

use maze\Http\Requests\Request;
use maze\Topic;
use Auth;

class EditTopic extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->topic = Topic::findOrFail($this->route('id'));

        //patikrinam ar useris turi teise redaguoti tema.
        if (Auth::check() && (Auth::user()->id == $this->topic->user_id && !$this->topic->is_blocked) || Auth::user()->can('manage_topics')) {
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
