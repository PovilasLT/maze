<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UpdateUser;
use maze\User;

class UsersController extends Controller {

	//Sukuria vartotoją
	public function create(CreateUser $request)
    {
        //Kuriam naują vartotoją
        $user = User::create($request->all());
        return redirect()->back();
    }

	//Išsaugoja vartotoją.
	public function update(UpdateUser $request) {
		return redirect()->back();
	}

	//Profilis
	public function show($slug, $id) {
		$user = User::find($id);
		if(!$user || !$user->slug == $slug)
		{
			abort(404);
			return false;
		}
		else
		{
			return view('users.profile', compact($user));
		}
	}

}
