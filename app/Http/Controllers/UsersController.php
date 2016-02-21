<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UserProfile;
use maze\Http\Requests\ChangeUsername;
use maze\User;
use maze\Notification;
use maze\Status;
use Auth;
use Image;
use Hash;
use Storage;

use maze\Events\AvatarWasUploaded;

use Stringy\StaticStringy as S;

use Illuminate\Http\Request;

class UsersController extends Controller {

	// Žinutės
	public function messages() {
		$user = Auth::user();

		$conversations = $user->conversations()->has('messages')->get();

		return view('user.messages', compact('user', 'conversations'));
	}

	//Profilis

	public function profile(UserProfile $request) {
		$user = Auth::user();

		//atnaujinam notificationu perskaitymo data
		$user->notifications_read = new \DateTime();
		$user->notification_count = 0;
		$user->save();
		
		$sort = $request->input('rodyti');
		$subsort = $request->input('subsort');

		if(!$sort || $sort == 'sekamieji')
		{
			switch ($subsort) {
				case 'temos':
					$items = Notification::following()->topicExists()->has('topic')->with('object')->latest()->paginate('10');
					break;
				case 'paminejimai':
					$items = Notification::mentions()->mentionExists()->with('object')->latest()->paginate('10');
					break;
				case 'pranesimai':
					$items = Notification::following()->replyExists()->has('reply.topic')->with('object')->latest()->paginate('10');
					break;
				case 'busenos':
					$items = Status::following()->with('comments')->latest()->paged();
					break;
				default:
					$items = Notification::following()->hasAll()->with('object')->latest()->paginate('10');
					break;
			}
		}
		else
		{
			$items = Status::latest()->paginate('10');
		}

		// dd(\DB::getQueryLog());

		return view('user.profile', compact('user', 'items', 'sort', 'subsort'));
	}

	public function show(Request $request, $slug) {
		$user = User::where('slug', $slug)->firstOrFail();

		$sort = $request->input('rodyti', 'visi');

		switch ($sort) {
			case 'temos':
				$items = $user->topics()->orderBy('created_at', 'DESC')->paginate('10');
				break;
			case 'pranesimai':
				$items = $user->replies()->orderBy('created_at', 'DESC')->paginate('10');
				break;
			case 'busenos':
				$items = $user->statuses()->orderBy('created_at', 'DESC')->paginate('10');
				break;
			default:
				$items = $user->topics()->paginate('10');
				break;
		}

		return view('user.show', compact('user', 'items', 'sort'));
	}

	public function follow($slug) {
		$user = User::where('slug', $slug)->firstOrFail();

		$following = $user->follow();


		if($following)
		{
			$user->increment('follower_count');
			flash()->success($user->username.' prenumeruojamas!');
		}
		else
		{
			$user->decrement('follower_count');
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

	public function changeUsername()
	{
		if(!Auth::user()->name_changes)
		{
			return view('user.username');
		}
		else
		{
			return redirect()->back();
		}
	}

	public function postChangeUsername(ChangeUsername $request)
	{

		$username = $request->input('username');

		Auth::user()->update([
			'username'	=> $username,
			'slug'		=> S::slugify($username),
			'name_changes' => 1,
		]);

		flash()->success('Vartotojo vardas sėkmingai pakeistas!');

		return redirect('/');
	}

	public function disableUser($id)
	{
		$user = Auth::user();
		if($user->can('manage_topics'))
		{
			$user = User::findOrFail($id);
			if($user->is_banned)
			{
				$user->is_banned = 0;
				$user->save();
				flash()->success('Vartotojas atblokuotas.');
			}
			else
			{
				$user->is_banned = 1;
				$user->save();
				flash()->success('Vartotojas užblokuotas.');
			}
		}
		return redirect()->back();
	}

	public function disableVote($id)
	{
		$user = Auth::user();
		if($user->can('manage_topics'))
		{
			$user = User::findOrFail($id);
			if($user->can_vote)
			{
				$user->can_vote = 0;
				$user->save();
				flash()->success('Balsai išjungti.');
			}
			else
			{
				$user->can_vote = 1;
				$user->save();
				flash()->success('Balsai įjungti.');
			}
		}
		return redirect()->back();
	}

}
