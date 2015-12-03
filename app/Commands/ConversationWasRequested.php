<?php

namespace maze\Commands;

use maze\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use maze\Modules\Confer\Conversation;
use maze\Modules\Confer\Confer;
use maze\User;
use Push;

class ConversationWasRequested extends Command implements SelfHandling, ShouldBeQueued {
	
	use InteractsWithQueue;

	protected $conversation;
	protected $requester;
	protected $is_group;
	protected $confer;

	public function __construct(Conversation $conversation, User $requester)
	{
		$this->conversation = $conversation;
		$this->requester = $requester;
		$this->confer = new Confer();
	}

	/**
	 * Handle the command.
	 */
	public function handle()
	{
		$other_participants = $this->conversation->participants()->where('id', '<>', $this->requester->id)->get();
		foreach ($other_participants as $participant) {
			Push::trigger('private-notifications-' . $participant->id, 'ConversationWasRequested', ['conversation' => $this->conversation, 'requester' => $this->requester]);
		}
	}

}