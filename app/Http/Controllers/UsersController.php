<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UpdateUser;
use maze\Http\Requests\UserProfile;
use maze\User;
use Auth;

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

	public function profile(UserProfile $request) {
		$user = Auth::user();
		$items = $user->notifications()->profile()->paginate('10');
		return view('user.profile', compact('user', 'items'));
	}

	public function show($slug) {
		$user = User::where('slug', $slug)->first();
		$items = $user->notifications()->profile()->paginate('20');
		return view('user.show', compact('user', 'items'));
	}

}
