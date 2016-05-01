<?php 

namespace maze\Messenger;

use maze\User;
use maze\Messenger\Message;
use maze\Messenger\Conversation;
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

		$receiver = $conversation->users()->where('user_id', 'NOT LIKE', $user->id)->firstOrFail();

		/**
		 * Issaunam du eventus. Vienas zinutes autoriui, kitas zinutes gavejui.
		 */
		event(new MessageWasSent($message, $user)); //autoriui
		event(new MessageWasSent($message, $receiver)); //gavejui

		return $message;
	}

}
