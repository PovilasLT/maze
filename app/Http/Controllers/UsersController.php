<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UpdateUser;
use maze\Http\Requests\UserProfile;
use maze\User;
use maze\Notification;
use Auth;

use Illuminate\Http\Request;

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

		$sort = $request->input('rodyti');
		$subsort = $request->input('sub');

		if(!$sort || $sort == 'sekamieji')
		{
			switch ($subsort) {
				case 'temos':
					$items = $user->notifications()->profile()->topics()->paginate('10');
					break;
				case 'paminejimai':
					$items = $user->notifications()->profile()->mentions()->paginate('10');
					break;
				case 'pranesimai':
					$items = $user->notifications()->profile()->replies()->paginate('10');
					break;
				case 'busenos':
					$items = $user->notifications()->profile()->statuses()->paginate('10');
					break;
				default:
					$items = $user->notifications()->profile()->paginate('10');
					break;
			}
		}
		else
		{
			$items = Notification::latest()->statuses()->groupBy('object_id')->paginate('20');
		}

		return view('user.profile', compact('user', 'items', 'sort', 'subsort'));
	}

	public function show(Request $request, $slug) {
		$user = User::where('slug', $slug)->firstOrFail();

		$sort = $request->input('rodyti', 'visi');

		if($sort)
		{
			switch ($sort) {
				case 'temos':
					$items = $user->notifications()->profile()->topics()->paginate('10');
					break;
				case 'paminejimai':
					$items = $user->notifications()->profile()->mentions()->paginate('10');
					break;
				case 'pranesimai':
					$items = $user->notifications()->profile()->replies()->paginate('10');
					break;
				case 'busenos':
					$items = $user->notifications()->profile()->statuses()->paginate('10');
					break;
				default:
					$items = $user->notifications()->profile()->paginate('10');
					break;
			}
		}
		else
		{
			$items = $user->notifications()->profile()->paginate('20');
		}

		return view('user.show', compact('user', 'items', 'sort'));
	}

	public function follow($slug) {
		$user = User::where('slug', $slug)->firstOrFail();

		$following = $user->follow();

		if($following)
		{
			flash()->success($user->username.' prenumeruojamas!');
		}
		else
		{
			flash()->success($user->username.' nebeprenumeruojamas!');
		}

		return redirect()->back();
	}

	public function followers($slug)
	{
		$user = User::where('slug', $slug)->firstOrFail();

		$followers = $user->followers()->latest()->paginate(100);

		return view('user.followers', compact('user', 'followers'));
	}

}
