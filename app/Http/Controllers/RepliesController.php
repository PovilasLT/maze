<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\DeleteReply;
use maze\Reply;
use maze\Http\Requests\SaveReply;
use maze\Http\Requests\CreateReply;
use maze\Http\Requests\AnswerReply;
use Auth;
use maze\Topic;
use Markdown;

class RepliesController extends Controller {

	function __construct() {
		//$this->middleware('auth');
	}

	public function store(CreateReply $request)
	{
		$data = $request->all();
		
		//Susitvarkom su markdown ir data
		$data['user_id'] 		= Auth::user()->id;
		$data['body_original']	= $data['body']; 
		$data['body'] 			= Markdown::convertToHtml($request->input('body'));

		$topic = Topic::findOrFail($data['topic_id']);
		Reply::create($data);
		$topic->increment('reply_count');

		$user = Auth::user();
		$user->increment('reply_count');

		flash()->success('Pranešimas sėkmingai išsaugotas!');
		return redirect()->back();
	}

	public function edit(EditReply $request, $id)
	{
		$reply = Reply::findOrFail($id);
		return view('reply.edit', compact('reply'));
	}

	public function save(SaveReply $request)
	{
		$reply = $request->reply;
		$reply->body_original = $request->input('body');
		$reply->body = Markdown::convertToHtml($request->input('body'));
		$reply->save();

		return redirect()->route('topic.show', [$reply->topic->slug]);
	}

	public function delete(DeleteReply $request)
	{
		$reply = $request->reply;
		$topic = $reply->topic;

		$reply->user->decrement('reply_count');

		$reply->delete();
		$topic->decrement('reply_count');
		flash()->success('Pranešimas sėkmingai ištrintas!');
		return redirect()->route('topic.show', [$topic->slug]);
	}

	public function markAnswer(AnswerReply $request, $id)
	{
		//Pažymim atsakymą.
		$reply = Reply::findOrFail($id);
		$reply->is_answer = 1;
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
