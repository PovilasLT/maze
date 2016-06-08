<?php

namespace maze\Http\Requests;

use maze\Http\Requests\Request;

class Donation extends Request
{
    protected $channel;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->channel = $this->route('channel_id');
        if($this->channel) {
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
            'body'      => 'max:255',
            'username'  => 'required|alpha_dash',
            'amount'    => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'username'  => 'Vardas',
            'amount'    => 'Suma'
        ];
    }
}
