<?php

namespace maze\Http\Controllers;

use maze\Http\Requests\UpdateUserSettings;
use maze\Http\Requests\UpdateTvSettings;
use maze\Http\Requests\UpdatePasswordSettings;
use Illuminate\Http\Request;
use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Events\AvatarWasUploaded;
use GuzzleHttp\Client;
use Auth;
use maze\User;
use Storage;
use maze\Streamer;
use Hash;

class SettingsController extends Controller
{

    public function userSettings() {
        $user = Auth::user();
        $settings_page = 'user';
        return view('settings.show', compact('user', 'settings_page'));
    }

    public function tvSettings(Request $request) {
        $user = Auth::user();
        $settings_page = 'tv';
        $streamer = $user->streamer;

        if($request->has('code'))
        {
            $client = new Client(['base_uri' => 'https://api.twitch.tv/kraken/']);
            $response = $client->post('oauth2/token', [
                'body' => 
                    'client_id='.urlencode(env('TWITCH_CLIENT_ID')).
                    '&client_secret='.urlencode(env('TWITCH_CLIENT_SECRET')).
                    '&grant_type=authorization_code&redirect_uri=https://'.env('DOMAIN').'/nustatymai/tv&code='.$request->get('code')
                    ,
            ]);
            $token = json_decode($response->getBody())->access_token;

            $response = $client->get('user?oauth_token='.$token);
            $twitch_user = json_decode($response->getBody());

            if($streamer)
            {
                $streamer->twitch = e($twitch_user->display_name); 
            }
            else
            {
                $streamer = Streamer::create([
                    'user_id' => Auth::user()->id,
                    'twitch' => e($twitch_user->display_name),
                ]);
            }

            $streamer->fullLoad();

            flash()->success('Twitch kanalas sėkmingai užregistruotas!');

            return redirect()->route('settings.tv');

        }

        return view('settings.show', compact('user', 'settings_page', 'streamer'));
    }

    public function passwordSettings() {
        $user = Auth::user();
        $settings_page = 'password';
        return view('settings.show', compact('user', 'settings_page'));
    }

    /**
     *  Bendri Vartotojo Nustatymai
     */
    
    public function userSettingsSave(UpdateUserSettings $request) {
        $settings = $request->input();

        $user = Auth::user();

        $_settings = [];

        $protected = [
            'username'
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

                if($request->file('avatar')->getMimeType() != 'image/gif') {
                    $saved = Image::make($request->file('avatar'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/avatars/'.$user->id.'/'.$filename.'.png'));
                    $ext = 'png';
                } else {
                    $saved = Storage::disk('public')->put('images/avatars/'.$user->id.'/'.$filename.'.gif', file_get_contents($request->file('avatar')));
                    $ext = 'gif';
                }

                //jeigu nieko nepridirbo su failu
                //istrinam pries tai buvusius failus
                //ir nustatom nauja avatara
                if($saved)
                {
                    Storage::disk('avatars')->delete($files);
                    $user->image_url = $filename.'.'.$ext;
                    if($ext != 'gif') {
                        event(new AvatarWasUploaded('public/images/avatars/'.$user->id.'/'.$filename.'.'.$ext));
                    }
                }
            }
        }

        $user->update($_settings);
        $user->save();

        flash()->success('Pakeitimai išsaugoti!');

        return redirect()->back();
    }

    /**
     *  TV Nustatymai
     */
    
    public function tvSettingsSave(UpdateTvSettings $request) {
        $streamer = Auth::user()->streamer;
        $streamer->update($request->all());
        flash()->success('Kanalo duomenys sėkmingai atnaujinti!');

        return redirect()->back();
    }
    
    /**
     *  Slaptazodzio nustatymai
     */


    public function passwordSettingsSave(UpdatePasswordSettings $request) {
        $user = Auth::user();
        if(Auth::check($user->password, $request->get('password')))
        {

            $user->password = Hash::make($request->get('npassword'));
            $user->save();
            
            flash()->success('Slaptažodis pakeistas!');
        }
        else
        {
            flash()->error('Blogas dabartinis slaptažodis!');
        }

        return redirect()->back();
    }

}
