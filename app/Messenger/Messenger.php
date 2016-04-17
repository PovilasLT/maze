<?php 

namespace maze\Messenger;

use maze\User;
use maze\Message;
use maze\Conversation;
use maze\UserConversationPivot;
use maze\Events\MessageWasSent;

class Messenger {

	public static function send(User $user, Conversation $conversation, $contents) 
	{

		$message = Message::create([
			'user_id' 			=> $user->id,
			'conversation_id'	=> $conversation->id,
			'body_original'		=> $contents,
			'body'				=> markdown($contents),
		]);

		$receiver = UserConversationPivot::where('conversation_id', $conversation->id)
		->where('user_id', 'NOT LIKE', $user->id)
		->firstOrFail();

		$receiver = $receiver->user;

		/**
		 * Issaunam du eventus. Vienas zinutes autoriui, kitas zinutes gavejui.
		 */
		event(new MessageWasSent($message, $user)); //autoriui
		event(new MessageWasSent($message, $receiver)); //gavejui

		return $message;
	}

}
