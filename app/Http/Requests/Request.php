<?php namespace maze\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

abstract class Request extends FormRequest
{
    public function forbiddenResponse()
    {
        flash('Veiksmas negalimas!');
        return redirect()->back();
    }

    public function user()
    {
        return Auth::check() ? Auth::user() : false;
    }
}
