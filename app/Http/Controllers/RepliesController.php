<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\DeleteReply;
use maze\Reply;
use maze\Http\Requests\SaveReply;
use maze\Http\Requests\CreateReply;
use Auth;
use maze\Topic;

class RepliesController extends Controller {

	function __construct() {
		//$this->middleware('auth');
	}

	public function store(CreateReply $request)
	{
		$data = $request->all();
		$data['user_id'] = Auth::user()->id;
		$topic = Topic::findOrFail($data['topic_id']);
		Reply::create($data);
		$topic->increment('reply_count');
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
		$reply->body = $request->input('body');
		$reply->save();

		return redirect('topic.show', [$reply->topic->slug, $reply->topic_id]);
	}

	public function delete(DeleteReply $request)
	{
		$reply = $request->reply;
		$reply->delete();
	}

}
