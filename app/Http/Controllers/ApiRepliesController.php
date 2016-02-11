<?php

namespace maze\Http\Controllers;

use maze\Http\Requests\UpdateReply;
use maze\Http\Requests\CreateReply;

use maze\Http\Controllers\Controller;

use maze\Events\ReplyWasCreated;
use maze\Events\UserWasMentioned;

use maze\Topic;
use maze\Reply;
use maze\User;
use maze\Mentions\Mention;

use Authorizer;

class ApiRepliesController extends Controller
{


    public function rules()
    {
        $request = new CreateReply();
        return response()->json(['rules' => $request->rules()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReply $request)
    {
        $data       = $request->all();
        $mention    = new Mention();
        $user       = User::find(Authorizer::getResourceOwnerId());

        //Susitvarkom su markdown ir data
        $data['user_id']        = $user->id;
        $data['body_original']  = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $data['body']           = markdown($data['body']);

        $topic = Topic::findOrFail($data['topic_id']);
        $reply = Reply::create($data);

        flash()->success('Pranešimas sėkmingai išsaugotas!');

        foreach($mention->users as $user)
        {
            event(new UserWasMentioned($reply, $user));
        }
        
        event(new ReplyWasCreated($reply, $topic, $user));

        return redirect()->route('replies.show', ['id' => $reply->id, 'access_token' => $request->input('access_token')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reply = Reply::with('topic')
                    ->with('topic.node')
                    ->with('topic.user')
                    ->with('topic.user.roles')
                    ->with('user')
                    ->with('user.roles')
                    ->where('id', $id)->firstOrFail();

        return response()->json($reply);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReply $request, $id)
    {
        $reply       = Reply::findOrFail($id);
        $mention    = new Mention();

        $data                   = $request->all();
        $reply->body_original   = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $reply->body            = markdown($data['body']);

        $reply->save();

        return redirect()->route('replies.show', [$id, 'access_token' => $request->input('access_token')]);
    }

}
