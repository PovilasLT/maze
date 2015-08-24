<?php

namespace maze\Commands;

use maze\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesCommands;
use maze\Commands\MessageWasSent;
use maze\Modules\Confer\Conversation;
use maze\Modules\Confer\Message;
use maze\Modules\Confer\Confer;
use maze\User;

class ParticipantLeft extends Command implements SelfHandling {

	use DispatchesCommands;

	protected $conversation;
	protected $leaver;

	public function __construct(Conversation $conversation, User $leaver)
	{
		$this->conversation = $conversation;
		$this->leaver = $leaver;
	}

	/**
	 * Handle the command.
	 */
	public function handle()
	{
		$this->makeLeftMessage();
	}

	private function makeLeftMessage()
	{
		$message = Message::create([
			'conversation_id' => $this->conversation->id,
			'body' => '<strong>' . $this->leaver->name . '</strong> left the conversation',
			'sender_id' => $this->leaver->id,
			'type' => 'conversation_message'
		]);
		$this->dispatch(new MessageWasSent($message));
	}

}