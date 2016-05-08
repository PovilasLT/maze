<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;
use maze\Http\Requests\CreateServerComment;
use maze\Http\Requests\UpdateServerComment;
use maze\Http\Requests\DeleteServerComment;
use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Server;
use maze\ServerComment;
use maze\Mentions\Mention;
use Auth;

class ServerCommentController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServerComment $request)
    {
        $data       = $request->all();
        $mention    = new Mention();

        //Susitvarkom su markdown ir data
        $data['user_id']        = Auth::user()->id;
        $data['body_original']  = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $data['body']           = markdown($data['body']);

        $server = Server::findOrFail($data['server_id']);
        $comment = ServerComment::create($data);

        flash()->success('Komentaras sėkmingai išsaugotas!');

        foreach($mention->users as $user)
        {
            event(new UserWasMentioned($comment, $user));
        }
        
        
        
        //redirectina tiesiai i ten, kur yra pranesimas
        return redirect()->route('server.show', [$server->slug, '#komentaras-'.$comment->id]);
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
        $comment = ServerComment::findOrFail($id);
        return view('server_comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServerComment $request, $id)
    {
        $comment      = ServerComment::findOrFail($id);
        $mention    = new Mention();

        $data                   = $request->all();
        $comment->body_original   = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $comment->body            = markdown($data['body']);

        $comment->save();

        flash()->success('Komentaras sėkmingai atnaujintas!');
        return redirect()->route('server.show', [$comment->server->slug, '#komentaras-'.$comment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteServerComment $request, $id)
    {
        $comment = $request->comment;
        $server = $comment->server;

        $user = $comment->user;

        $comment->delete();

        flash()->success('Komentaras sėkmingai ištrintas!');

        return redirect()->route('server.show', [$server->slug]);
    }
}
