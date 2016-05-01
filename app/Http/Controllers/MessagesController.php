<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\CreateMessage;
use maze\User;
use maze\Messenger\Message;
use maze\Messenger\Conversation;
use maze\Messenger\Messenger;

use Illuminate\Http\Request;

use Auth;

class MessagesController extends Controller {

	public function __construct()
	{
		$this->middleware('loggedIn');
	}

	public function store(CreateMessage $request)
	{
		$user = Auth::user();
		$data = $request->all();
		$conversation = Conversation::findOrFail($data['conversation_id']);

		$message = Messenger::send($user, $conversation, $request->input('body'));

		if($request->ajax()) {
			return 'OK';
		} else {
			return redirect()->back();
		}
	}

	public function read(Conversation $conversation, Message $message)
	{
		if($message->conversation_id == $conversation->id) {
			$message->update(['is_read' => 1]);
		}
	}

}