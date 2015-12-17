<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateUser;
use maze\Http\Requests\UpdateUser;
use maze\Http\Requests\UserProfile;
use maze\User;
use maze\Notification;
use Auth;
use Image;
use Hash;
use Storage;

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
				
				$files = Storage::disk('avatar')->files($user->id);

				$files = array_map(function($file) use($user) {
					return '/'.$user->id.'/'.$file;
				}, $files);

				$filename = str_random(40);
				$saved = Image::make($request->file('avatar'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/avatars/'.$user->id.'/'.$filename.'.png'));

				//jeigu nieko nepridirbo su failu
				//istrinam pries tai buvusius failus
				//ir nustatom nauja avatara
				if($saved)
				{
					Storage::disk('avatar')->delete($files);
					$user->image_url = $filename.'.png';
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

}
