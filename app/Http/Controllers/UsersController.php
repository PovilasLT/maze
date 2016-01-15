<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UpdateUser;
use maze\Http\Requests\UserProfile;
use maze\Http\Requests\ChangeUsername;
use maze\User;
use maze\Notification;
use Auth;
use Image;
use Hash;
use Storage;

use maze\Events\AvatarWasUploaded;

use Stringy\StaticStringy as S;

use Illuminate\Http\Request;

class UsersController extends Controller {
	//Išsaugoja vartotoją.
	public function update(UpdateUser $request) {
		$settings = $request->input();

		$user = Auth::user();

		$_settings = [];

		$protected = [
			'username',
			'password',
			'npassword',
		];

		foreach($settings as $key => $setting)
		{

			if(!array_key_exists($key, $protected))
			{
				$_settings[$key] = $setting;
			}
			
			//processinam avatara
			if($request->file('avatar'))
			{

				//isvalom direktorija.
				
				$files = Storage::disk('avatars')->files($user->id);

				$filename = str_random(40);

				if(!Storage::disk('public')->has('images/avatars/'.$user->id))
				{
					Storage::disk('public')->makeDirectory('images/avatars/'.$user->id);
				}

				$saved = Image::make($request->file('avatar'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/avatars/'.$user->id.'/'.$filename.'.png'));

				//jeigu nieko nepridirbo su failu
				//istrinam pries tai buvusius failus
				//ir nustatom nauja avatara
				if($saved)
				{
					Storage::disk('avatars')->delete($files);
					$user->image_url = $filename.'.png';
					event(new AvatarWasUploaded('public/images/avatars/'.$user->id.'/'.$filename.'.png'));
				}
			}

			if($key == 'password')
			{
				if(Hash::check($setting, $user->password))
				{
					$user->password = Hash::make($settings['npassword']);
				}
				else
				{
					flash()->error('Blogas slaptažodis!');
					return redirect()->back();
				}
			}
		}

		//nelabai geras sprendimas
		//veliau sugalvoti ka nors kito
		unset($_settings['password']);
		unset($_settings['npassword']);

		$user->update($_settings);
		$user->save();

		flash()->success('Pakeitimai išsaugoti!');

		return redirect()->back();
	}

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
					$items = Notification::following()->statusExists()->has('status')->with('object')->latest()->paginate('10');
					break;
				default:
					$items = Notification::following()->hasAll()->with('object')->latest()->paginate('10');
					break;
			}
		}
		else
		{
			$items = Notification::statuses()->hasAll()->with('object')->latest()->paginate('10');
		}

		// dd(\DB::getQueryLog());

		return view('user.profile', compact('user', 'items', 'sort', 'subsort'));
	}

	public function show(Request $request, $slug) {
		$user = User::where('slug', $slug)->firstOrFail();

		$sort = $request->input('rodyti', 'visi');

		switch ($sort) {
			case 'temos':
				$items = Notification::activities($user->id)->has('topic')->with('object')->latest()->topics()->paginate('10');
				break;
			case 'pranesimai':
				$items = Notification::activities($user->id)->has('reply.topic')->with('object')->latest()->replies()->paginate('10');
				break;
			case 'busenos':
				$items = Notification::activities($user->id)->has('status')->with('object')->latest()->statuses()->paginate('10');
				break;
			default:
				$items = Notification::activities($user->id)->hasAll()->with('object')->latest()->paginate('10');
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

	public function settings()
	{
		$user = Auth::user();
		return view('user.settings', compact('user'));
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
