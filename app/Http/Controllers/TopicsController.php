<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use maze\Http\Requests\CreateTopic;
use maze\Http\Requests\EditTopic;
use maze\Http\Requests\AdminTopic;
use maze\Http\Requests\DeleteTopic;
use maze\Http\Requests\UpdateTopic;
use maze\Events\TopicWasCreated;
use maze\Events\TopicWasDeleted;
use maze\Events\UserWasMentioned;

use maze\Topic;
use maze\Node;
use maze\Poll;
use maze\Answer;

use Auth;
use Markdown;
use Cache;

use maze\Mentions\Mention;


use Illuminate\Http\Request;

class TopicsController extends Controller {


	public function __construct()
	{
		$this->middleware('loggedIn', [
			'except' => [
				'show'
			]
		]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$nodes = Node::parents();
		$node_id = false;

		if($request->has('skiltis'))
			$node_id = $request->input('skiltis');

		return view('topic.create', compact('nodes', 'node_id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTopic $request)
	{
		$data 		= $request->all();
		$mention 	= new Mention();

		// dd($data);

		//Susitvarkom su Markdown
		$data['body_original']	= $data['body']; 
		$data['body']			= $mention->parse($data['body']);
		$data['body'] 			= markdown($data['body']);
		$data['user_id'] 		= Auth::user()->id;

		$topic = Topic::create($data);
		$user = Auth::user();

		foreach($mention->users as $user)
		{
			event(new UserWasMentioned($topic, $user));
		}

		event(new TopicWasCreated($topic, $user));

		//Jeigu tema yra Apklausa, sukurti apklausą
		// if($data['type'] == 3)
		// {
		// 	$poll = Poll::create([
		// 		'topic_id' => $topic->id
		// 	]);

		// 	foreach($data['answers'] as $answer)
		// 	{
		// 		if($answer)
		// 		{
		// 			Answer::create([
		// 				'poll_id'	=> $poll->id,
		// 				'title'		=> $answer
		// 			]);
		// 		}
		// 	}
		// }
		
		flash()->success('Tema sėkmingai sukurta!');
		//grazinam useri i sukurta topic'a
		return redirect()->route('topic.show', ['slug' => $topic->slug]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$topic = Topic::where('slug', $slug)->firstOrFail();

		if($topic->node->parent_node)
		{
			$expandable = $topic->node->parent_node;
		}
		else
		{
			$expandable = $topic->node_id;
		}
		
		if(Auth::check())
		{
			$replies = $topic->replies()->lists('id');
			
			// dd(Auth::user()->notifications()->whereIn('object_id', $replies)->where('object_type', 'reply')->get());

			Auth::user()->notifications()->whereIn('object_id', $replies)->where('object_type', 'reply')->update(['read_at' => new \DateTime()]);

			//bust da cache
			Cache::forget(Auth::user()->id.'_notification_count');
		}

		//padidina view counteri.
		$topic->increment('view_count');

		return view('topic.show', compact('topic', 'expandable'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(EditTopic $request, $id)
	{
		$nodes = Node::parents();
		$topic = $request->topic;
		return view('topic.edit', compact('topic', 'nodes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateTopic $request, $id)
	{
		$data 		= $request->all();
		$mention 	= new Mention();


		//Susitvarkom su Markdown
		$topic = $request->topic;

		$topic->title 			= $data['title'];
		$topic->body_original	= $data['body'];
		$data['body']			= $mention->parse($data['body']);
		$topic->body			= markdown($data['body']);
		$topic->type 			= $data['type'];
		$topic->node_id			= $data['node_id'];

		$topic->save();

		flash()->success('Tema sėkmingai atnaujinta!');
		//grazinam useri i sukurta topic'a
		return redirect()->route('topic.show', ['slug' => $topic->slug]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(DeleteTopic $request)
	{
		$topic = $request->topic;
		$topic->delete();
		$user = Auth::user();

		event(new TopicWasDeleted($topic, $user));

		flash()->success('Tema sėkmingai ištrinta!');

		return redirect()->route('node.show', ['slug' => $topic->node->slug]);
	}

	public function bump(AdminTopic $request, $id)
	{
		$topic = $request->topic;
		$topic->touch();
		$topic->save();

		flash()->success('Tema sėkmingai pakelta!');

		return redirect()->back();
	}

	public function pinGlobal(AdminTopic $request, $id)
	{
		$topic = $request->topic;
		$topic->order = 1;
		$topic->save();

		flash()->success('Tema sėkmingai prisegta!');

		return redirect()->back();
	}

	public function pinLocal(AdminTopic $request, $id)
	{
		$topic = $request->topic;
		$topic->pin_local = 1;
		$topic->save();

		flash()->success('Tema sėkmingai prisegta!');

		return redirect()->back();
	}

	public function unpin(AdminTopic $request, $id)
	{
		$topic = $request->topic;
		$topic->pin_local = 0;
		$topic->order = 0;
		$topic->save();

		flash()->success('Tema sėkmingai atsegta!');

		return redirect()->back();
	}

	public function sink(AdminTopic $request, $id)
	{

		$topic = $request->topic;
		$topic->order = -1;
		$topic->pin_local = -1;
		$topic->save();
		flash()->success('Tema sėkmingai nuskandinta!');

		return redirect()->back();
	}

	public function lock(AdminTopic $request, $id)
	{
		$topic = $request->topic;
		if($topic->is_blocked)
		{
			$topic->is_blocked = 0;
			flash()->success('Tema sėkmingai atrakinta!');
		}
		else {
			$topic->is_blocked = 1;
			flash()->success('Tema sėkmingai užraktinta');
		}
		$topic->save();

		return redirect()->back();
	}

}
