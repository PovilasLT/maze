<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\ShowConversation;
use maze\Http\Requests\CreateConversation;

use maze\User;
use maze\Message;
use maze\Conversation;
use maze\Messenger\Messenger;

use Illuminate\Http\Request;
use Auth;

class ConversationsController extends Controller {

	public function __construct()
	{
		$this->middleware('loggedIn');
	}

	public function index(Request $request)
	{
		$user = Auth::user();
		$conversations = $user->conversations()->latest()->with([
			'users' => function($query) use($user) {
				return $query->where('user_id', 'NOT LIKE', $user->id)->where('is_banned', false);
			},
			'messages' => function($query) {
				return $query;
			}
		])->get();

		$user->update(['message_count' => 0]);
		$username = $request->input('username');

		return view('conversation.index', compact('conversations', 'username'));
	}

	public function show(ShowConversation $request, $id)
	{

		$conversation = $request->conversation;
		$messages = $conversation->messages()->latest()->paginate(30);
		$users = $conversation->users;
		$receiver = $conversation->receiver;

		return view('conversation.show', compact('conversation', 'messages', 'users', 'receiver'));
	}

	public function create($id) {
		$user = Auth::user();
		$participant = User::findOrFail($id);
		$conversation = $user->conversations()->whereIn('id', $participant->conversations()->lists('id'))->first();
		if($conversation)
		{
			return redirect()->route('conversation.show', $conversation->id);
		}
		else
		{
			return redirect()->route('conversation.index', ['username' => $participant->username]);
		}
	}

	public function store(CreateConversation $request)
	{
		$user = Auth::user();
		$receiver = User::where('username', $request->input('username'))->first();

		if(!$receiver)
		{
			flash()->error('Gavėjas nerastas!');
			return redirect()->back()->withInput();
		}
		else
		{
			$conversation = $user->conversations()->whereIn('id', $receiver->conversations()->lists('id'))->first();
			if(!$conversation)
			{
				$conversation = Conversation::create(['secret' => str_random(70)]);
				$user->conversations()->attach($conversation->id);
				$receiver->conversations()->attach($conversation->id);
			}

			$message = Messenger::send($user, $conversation, $request->input('body'));

			return redirect()->route('conversation.show', $conversation->id);
		}
	}

}