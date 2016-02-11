<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;
use maze\Http\Requests\CreateTopic;
use maze\Http\Requests\UpdateTopic;
use maze\Events\UserWasMentioned;
use maze\Events\TopicWasCreated;


use maze\Mentions\Mention;
use Markdown;
use maze\TopicType;

use Auth;
use Log;



class ApiTopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with('user')
        ->with('node')
        ->with('replies.user')
        ->with('user.roles')
        ->with('node.parent')
        ->with('type')
        ->paginate(20);
        return response()->json($topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $createtopic = new CreateTopic();
        $types = TopicType::all();
        return response()->json(['rules' => $createtopic->rules(), 'attributes' => $createtopic->attributes(), 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopic $request, Authorizer $authorizer)
    {
        $data       = $request->all();
        $mention    = new Mention();
        $token      = (string)$authorizer->getAccessToken();

        //Susitvarkom su Markdown
        $data['body_original']  = $data['body']; 
        $data['body']           = $mention->parse($data['body']);
        $data['body']           = markdown($data['body']);
        $data['user_id']        = Auth::user()->id;

        $topic = Topic::create($data);
        $user = Auth::user();

        foreach($mention->users as $user)
        {
            event(new UserWasMentioned($topic, $user));
        }

        event(new TopicWasCreated($topic, $user));

        return redirect()->route('api.topics.show', ['id' => $topic->id, 'access_token' => $token]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::with('user')->with('replies.user')->with('user.roles')->with('node')->with('type')->find($id);
        if(!$topic)
        {
            return response()->json([
                'error' => 'Topic '.$id.' not found'
                ]);
        }
        else 
        {
            return response()->json($topic);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = new UpdateTopic();
        return response()->json(['rules' => $request->rules(), 'attributes' => $request->attributes()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopic $request, $id)
    {
        $data       = $request->all();
        $mention    = new Mention();
        $token      = (string)Authorizer::getAccessToken();

        //Susitvarkom su Markdown
        $topic = $request->topic;

        $topic->title           = $data['title'];
        $topic->body_original   = $data['body'];
        $data['body']           = $mention->parse($data['body']);
        $topic->body            = markdown($data['body']);
        $topic->type_id         = $data['type_id'];
        $topic->node_id         = $data['node_id'];

        $topic->save();

        return redirect()->route('api.topics.show', ['id' => $topic->id, 'access_token' => $token]);
    }
}
