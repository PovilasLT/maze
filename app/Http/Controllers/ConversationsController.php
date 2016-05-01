<?php namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\ShowConversation;
use maze\Http\Requests\CreateConversation;
use maze\User;
use maze\Messenger\Message;
use maze\Messenger\Conversation;
use maze\Messenger\Messenger;

use Auth;

class ConversationsController extends Controller {

	public function __construct()
	{
		$this->middleware('loggedIn');
	}

	public function index(Request $request)
	{
		$user = Auth::user();
		
		$conversations = $user->conversations()->latest()->withUsersAndMessages($user)->limit(30)->get();

		$user->update(['message_count' => 0]);
		$username = $request->input('username');

		return view('conversation.index', compact('conversations', 'username', 'conversation'));
	}

	public function show(ShowConversation $request, Conversation $conversation)
	{
		$user = Auth::user();
		
		$conversations = $user->conversations()->latest()->withUsersAndMessages($user)->limit(30)->get();
				
		$messages = $conversation->messages()->latest()->paginate(30);
		$receiver = $conversation->users()->where('user_id', 'NOT LIKE', $user->id)->first();

		$conversation->messages()->where('user_id', '<>', $user->id)->update(['is_read' => 1]);

		return view('conversation.show', compact('conversation', 'messages', 'users', 'user', 'receiver', 'conversations'));
	}

	public function create(User $receiver) {
		$user = Auth::user();
		$conversation = Conversation::joint([$user->id, $receiver->id])->first();
		if($conversation) {
			return redirect()->route('conversation.show', $conversation->id);
		} else {
			return redirect()->route('conversation.index', ['username' => $receiver->username]);
		}
	}

	public function store(CreateConversation $request)
	{
		$user = Auth::user();
		$receiver = User::where('username', $request->input('username'))->first();

		if(!$receiver || $receiver->id == $user->id) {
			flash()->error('Gavėjas nerastas!');
			return redirect()->back()->withInput();
		} else {
			$conversation = Conversation::joint([$user->id, $receiver->id])->first();
			if(!$conversation) {
				$conversation = Conversation::create();
				$user->conversations()->attach($conversation->id);
				$receiver->conversations()->attach($conversation->id);
			}

			$message = Messenger::send($user, $conversation, $request->input('body'));

			return redirect()->route('conversation.show', $conversation->id);
		}
	}
}