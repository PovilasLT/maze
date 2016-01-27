<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests\UpdateUser;
use maze\Http\Controllers\Controller;

use maze\User;
use Log;

use Authorizer;
//use LucaDegasperi\OAuth2Server\Authorizer;


class ApiUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Authorizer $authorizer)
    {
        $user_id = $authorizer->getResourceOwnerId(); // the token user_id
        $user = User::find($user_id);// get the user data from database
        $users = User::paginate(50);
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        var_dump(Authorizer::getAccessToken());
        $lol = new UpdateUser();
        return response()->json(['attributes' => $lol->attributes(), 'rules' => $lol->rules()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, Authorizer $authorizer)
    {
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

        return redirect()->route('api.users.show', ['id' => $user->id, 'access_token' => $authorizer->getAccessToken()]);
    }

}
