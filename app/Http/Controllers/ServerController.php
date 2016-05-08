<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests\CreateServer;
use maze\Http\Requests\DeleteServer;
use maze\Http\Requests\AdminServer;
use maze\Http\Requests\EditServer;
use maze\Http\Requests\UpdateServer;
use maze\Http\Controllers\Controller;

use maze\ServerGame;
use maze\Server;
use maze\User;

use maze\Mentions\Mention;

use Auth;
use Storage;
use Image;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tab = $request->input('rodyti');
        $game = $request->input('zaidimas');
        $query = Server::select();

        // Administracija mato ir nepatikrintus
        if(Auth::user()->can('manage_servers'))
        {
            //$query = Server::get();
        }
        else
        {
            $query = $query->confirmed();
        }

        if(!$tab || $tab == 'naujausi')
        {
            $query = $query->latest();
        }
        else if($tab == 'populiariausi')
        {
            $query = $query->popular();
        }

        if($game)
        {
            $servergame = ServerGame::where('slug', '=', $game)->firstOrFail();
            $query = $query->games($servergame);
        }
        $servers = $query->paginate(20);
        return view('server.list', compact('tab', 'servers', 'tab', 'game'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game_types = ServerGame::get();
        return view('server.create', compact('game_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServer $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $mention    = new Mention();

        $data['body_original']  = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $data['body']           = markdown($data['body']);
        $data['user_id']        = $user->id;
        $data['is_confirmed']   = 0;

        $server = Server::create($data);
        if($request->file('logo') && $request->file('logo')->getMimeType() != 'image/gif')
        {
            $fname = $server->id.'-'.str_random(40).'.png';
            $saved = Image::make($request->file('logo'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/servers/'.$fname));
            if($saved)
            {
                $server->logo = $fname;
                $server->save();
            }
        }
        
        return redirect()->route('server.show', $server->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $server = Server::where('slug', $slug)->firstOrFail();
        return view('server.show', compact('server'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditServer $request, $slug)
    {
        $game_types = ServerGame::get();
        $server = $request->gameserver;
        return view('server.edit', compact('server', 'game_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServer $request, $id)
    {
        $data = $request->all();
        $server = $request->gameserver;
        $mention    = new Mention();

        $server->name           = $data['name'];
        $server->body_original  = $data['body'];
        $data['body']           = $mention->parse($data['body']);
        $server->body           = markdown($data['body']);
        $server->ip             = $data['ip'];
        $server->website        = $data['website'];
        $server->port           = $data['port'];

        // Jei naujas logo, do shit
        if($request->hasFile('logo'))
        {
            if(Storage::disk('public')->has('images/servers/'.$server->logo))
            {
                Storage::disk('public')->delete('images/servers/'.$server->logo);
            }
            $fname = $server->id.'-'.str_random(40).'.png';
            $saved = Image::make($request->file('logo'))->fit(150,150)->encode('png')->encode('png', 100)->save(public_path('images/servers/'.$fname));
            if($saved)
            {
                $server->logo = $fname;
            }
        }

        $server->save();

        flash()->success('Serveris sėkmingai atnaujintas!');
        return redirect()->route('server.show', [$server->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteServer $request, $id)
    {
        $server = $request->gameserver;
       
        $server->delete();
        flash()->success('Serveris ištrintas');
        return redirect()->route('server.list');
    }

    public function lock(AdminServer $request, $id)
    {
        $server = Server::where('id', $id)->firstOrFail();
        if($server->is_blocked)
        {
            flash()->success('Serveris atrakintas');
            $server->is_blocked = 0;
        }
        else
        {
            flash()->success('Serveris užrakintas');
            $server->is_blocked = 1;
        }
        $server->save();
        return redirect()->route('server.show', [$server->slug]);
    }
}
