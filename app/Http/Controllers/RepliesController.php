<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\DeleteReply;
use maze\Reply;
use maze\Http\Requests\SaveReply;
use maze\Http\Requests\CreateReply;

class RepliesController extends Controller {

	function __construct() {
		//$this->middleware('auth');
	}

	public function store(CreateReply $request)
	{
		Reply::create($request->all());
		return redirect()->back();
	}

	public function edit($id)
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
