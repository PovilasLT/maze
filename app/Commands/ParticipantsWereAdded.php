<?php

namespace maze\Commands;

use maze\Commands\Command;
use maze\User;
use maze\Commands\ConversationWasRequested;
use maze\Commands\MessageWasSent;
use maze\Modules\Confer\Confer;
use maze\Modules\Confer\Conversation;
use maze\Modules\Confer\Message;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesCommands;

class ParticipantsWereAdded extends Command implements SelfHandling {

	use DispatchesCommands;

	protected $conversation;
	protected $conversation_was_created;
	protected $confer;
	protected $users;
	protected $inviter;

	public function __construct(Conversation $conversation, Array $users, User $inviter, $conversation_was_created)
	{
		$this->conversation = $conversation;
		$this->users = $users;
		$this->inviter = $inviter;
		$this->conversation_was_created = $conversation_was_created;
		$this->confer = new Confer();
	}

	/**
	 * Handle the command.
	 */
	public function handle()
	{
		if ($this->conversation_was_created)
		{
			$this->makeConversationCreatedMessage();
			//$this->makeNameSetMessage();
		}	
		$this->makeJoinMessage();
		$this->inviteUsers();
	}

	private function inviteUsers()
	{
		$users = $this->conversation_was_created ? $this->conversation->participants()->ignoreMe()->get() : User::whereIn('id', $this->users)->get();
		foreach ($users as $user)
		{
			$this->dispatch(new ConversationWasRequested($this->conversation, $this->inviter, $user));
		}
	}

	private function makeJoinMessage()
	{
		$users = $this->conversation_was_created ? confer_make_list($this->conversation->participants()->ignoreMe()->lists('username')) : confer_make_list(User::whereIn('id', $this->users)->lists('username'));
		$message = Message::create([
			'conversation_id' => $this->conversation->id,
			'body' => '<strong>' . $users . '</strong> joined the conversation on ' . $this->inviter->username . '\'s invitation',
			'sender_id' => $this->inviter->id,
			'type' => 'conversation_message'
		]);
		$this->dispatch(new MessageWasSent($message));
	}

	private function makeConversationCreatedMessage()
	{
		$message = Message::create([
			'conversation_id' => $this->conversation->id,
			'body' => $this->inviter->username . ' created the conversation and called it <strong>' . $this->conversation->name . '</strong>',
			'sender_id' => $this->inviter->id,
			'type' => 'conversation_message'
		]);
		$this->dispatch(new MessageWasSent($message));
	}

	private function makeNameSetMessage()
	{
		$message = Message::create([
			'conversation_id' => $this->conversation->id,
			'body' => $this->inviter->username . ' set the name to <strong>' . $this->conversation->name . '</strong>',
			'sender_id' => $this->inviter->id,
			'type' => 'conversation_message'
		]);
		$this->dispatch(new MessageWasSent($message));
	}

}