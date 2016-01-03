<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Reply;
use maze\Http\Requests\SaveReply;
use maze\Http\Requests\CreateReply;
use maze\Http\Requests\AnswerReply;
use maze\Http\Requests\EditReply;
use maze\Http\Requests\DeleteReply;
use maze\Http\Requests\UpdateReply;
use maze\Events\ReplyWasCreated;
use maze\Events\ReplyWasDeleted;
use maze\Events\UserWasMentioned;
use Auth;
use maze\Topic;
use Markdown;
use maze\Mentions\Mention;

class RepliesController extends Controller {

	function __construct() {
		//$this->middleware('auth');
	}

	public function store(CreateReply $request)
	{
		$data 		= $request->all();
		$mention 	= new Mention();

		//Susitvarkom su markdown ir data
		$data['user_id'] 		= Auth::user()->id;
		$data['body_original']	= $data['body']; 
		$data['body']			= $mention->parse($data['body']);
		$data['body'] 			= markdown($data['body']);

		$topic = Topic::findOrFail($data['topic_id']);
		$reply = Reply::create($data);

		flash()->success('Pranešimas sėkmingai išsaugotas!');

		foreach($mention->users as $user)
		{
			event(new UserWasMentioned($reply, $user));
		}
		
		event(new ReplyWasCreated($reply, $topic, Auth::user()));
		
		//redirectina tiesiai i ten, kur yra pranesimas
		return redirect()->route('topic.show', [$topic->slug, '#pranesimas-'.$reply->id]);
	}

	public function edit(EditReply $request, $id)
	{
		$reply = Reply::findOrFail($id);
		return view('reply.edit', compact('reply'));
	}

	public function update(UpdateReply $request, $id)
	{
		$reply 		= Reply::findOrFail($id);
		$mention 	= new Mention();

		$data 					= $request->all();
		$reply->body_original	= $data['body']; 
		$data['body']			= $mention->parse($data['body']);
		$reply->body 			= markdown($data['body']);

		$reply->save();

		flash()->success('Pranešimas sėkmingai atnaujintas!');
		return redirect()->route('topic.show', [$reply->topic->slug]);
	}

	public function destroy(DeleteReply $request)
	{
		$reply = $request->reply;
		$topic = $reply->topic;

		$user = $reply->user;

		$reply->delete();

		flash()->success('Pranešimas sėkmingai ištrintas!');

		event(new ReplyWasDeleted($reply, $topic, $user));

		return redirect()->route('topic.show', [$topic->slug]);
	}

	public function markAnswer(AnswerReply $request, $id)
	{
		//Pažymim atsakymą.
		$reply = Reply::findOrFail($id);
		$reply->is_answer = 1;
		$reply->user->increment('karma_count', 5);
		$reply->save();


		//Užrakinam temą.
		$topic = Topic::findOrFail($reply->topic_id);
		$topic->is_blocked = 1;
		$topic->is_answered = 1;
		$topic->save();

		flash()->success('Pranešimas pažymėtas kaip atsakymas!');

		return redirect()->route('topic.show', [$topic->slug]);
	}

}
