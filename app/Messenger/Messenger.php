<?php 

namespace maze\Messenger;

use maze\User;
use maze\Message;
use maze\Conversation;
use maze\Events\MessageWasSent;

class Messenger {

	public static function send(User $user, Conversation $conversation, $contents) {

		$message = Message::create([
			'user_id' 			=> $user->id,
			'conversation_id'	=> $conversation->id,
			'body_original'		=> $contents,
			'body'				=> e($contents),
		]);

		event(new MessageWasSent($message, $user));

		return $message;
	}

}
