<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests\ShowServer;
use maze\Http\Requests\CreateServer;
use maze\Http\Requests\DeleteServer;
use maze\Http\Requests\AdminServer;
use maze\Http\Requests\EditServer;
use maze\Http\Requests\UpdateServer;
use maze\Http\Requests\RejectServer;
use maze\Http\Controllers\Controller;

use maze\Events\ServerWasRejected;
use maze\Events\ServerWasApproved;
use maze\Events\ServerWasDeleted;
use maze\Events\ServerWasCreated;
use maze\Events\UserWasMentioned;

use maze\ServerGame;
use maze\GameServer;
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
        $query = GameServer::select();

        // Administracija mato ir nepatikrintus
        if(Auth::user()->can('manage_servers'))
        {
            $query = GameServer::where('is_waiting_confirmation', '=', '1')->orWhere('is_confirmed', '=', '1');
            flash()->info('Yra '.GameServer::waitingConfirmation()->count().' nepatvirtinti(-ų) serveriai(-ų)!');
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
        else if($tab == 'mano')
        {
            $query = GameServer::ofUser(Auth::user());
        }
        else if($tab == 'nepatvirtinti' && Auth::user()->can('manage_servers'))
        {
            $query = $query->waitingConfirmation();
        }
        else
            redirect()->route('server.list');

        if($game)
        {
            $servergame = ServerGame::where('slug', '=', $game)->firstOrFail();
            $query = $query->games($servergame);
        }
        $servers = $query->paginate(20);
        return view('server.list', compact('tab', 'servers', 'tab', 'game', 'unconfirmed_count', 'confirmation'));
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
        $data['is_waiting_confirmation'] = 1;

        $server = GameServer::create($data);
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

        foreach($mention->users as $user)
        {
            event(new UserWasMentioned($server, $user));
        }

        event(new ServerWasCreated($server, $user));
        
        return redirect()->route('server.show', $server->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowServer $request, $slug)
    {
        $server = GameServer::where('slug', $slug)->firstOrFail();
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

        // Jei serveris nepatvirtintas, vėl grįžta į eilę
        if(!$server->is_confirmed)
            $server->is_waiting_confirmation = 1;

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
       
        event(new ServerWasDeleted($server, Auth::user()));

        $server->delete();

        flash()->success('Serveris ištrintas');
        return redirect()->route('server.list');
    }

    public function lock(AdminServer $request, $id)
    {
        $server = GameServer::where('id', $id)->firstOrFail();
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

    public function confirm(AdminServer $request, $slug)
    {
        $request->gameserver->is_waiting_confirmation = 0;
        $request->gameserver->is_confirmed = 1;
        $request->gameserver->save();

        event(new ServerWasApproved($request->gameserver));

        flash()->success('Serveris sėkmingai patvirtintas ir pridėtas prie visų.');
        return redirect()->route('server.list');
    }

    public function reject(RejectServer $request, $slug)
    {
        $data = $request->all();

        $data['user_id'] = $request->gameserver->user->id;
        $data['admin_id'] = Auth::user()->id;

        $request->gameserver->is_waiting_confirmation = 0;
        $request->gameserver->save();

        event(new ServerWasRejected($request->gameserver));

        flash()->error('Serveris atmestas, įkėlėjas bus informuotas');
        return redirect()->route('server.list');
    }
}
