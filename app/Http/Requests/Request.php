<?php namespace maze\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function forbiddenResponse()
    {
        flash('Veiksmas negalimas!');
        return redirect()->back();
    }
}
