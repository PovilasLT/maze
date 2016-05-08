<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Requests\CreateServerGame;
use maze\Http\Controllers\Controller;
use maze\ServerGame;
use Auth;
use Image;
use Storage;

class ServerGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = ServerGame::get();
        return view('server_game.create', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServerGame $request)
    {
        $user = Auth::user();
        $game = ServerGame::create($request->all());


        if($request->file('default_logo') && $request->file('default_logo')->getMimeType() != 'image/gif')
        {
            if(!Storage::disk('public')->has('images/servers/default/'))
            {
                Storage::disk('public')->makeDirectory('images/servers/default/');
            }
            $fname = $game->id.'-'.str_random(40).'.png';
            $saved = Image::make($request->file('default_logo'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/servers/default/'.$fname));
            if($saved)
            {
                $game->default_logo = $fname;
                $game->save();
            }
        }
        
        return redirect()->route('server.list', ['zaidimas' => $game->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
