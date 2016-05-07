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
        $lol = new UpdateUser();
        return response()->json(['attributes' => $lol->attributes(), 'rules' => $lol->rules()]);
    }
}
