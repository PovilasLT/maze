<?php

namespace maze\Modules\Confer;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
	
	protected $fillable = ['name', 'is_private'];
	protected $table = 'confer_conversations';
	protected $guarded = ['id'];

	// Relationships
	
	/**
	 * Get the participants of the conversation
	 * 
	 * @return belongsToMany
	 */
	public function participants()
	{
		return $this->belongsToMany('maze\User', 'confer_conversation_participants', 'user_id', 'conversation_id');
	}

	/**
	 * Get the messages in the conversation
	 * 
	 * @return hasMany
	 */
	public function messages()
	{
		return $this->hasMany('maze\Modules\Confer\Message', 'conversation_id');
	}

	public function isGlobal()
	{
		return $this->id == 1;
	}

	public function isPrivate()
	{
		return $this->is_private;
	}

	public function getChannel()
	{
		return 'private-conversation-' . $this->id;
	}

	/**
	 * Get the users who could be invited into the conversation
	 * 
	 * @return Collection
	 */
	public function getPotentialInvitees()
	{
		$current_participants = $this->participants()->lists('id');
		return \maze\User::whereNotIn('id', $current_participants)->get();

	}

	public function createNewWithAdditionalParticipants(Array $users, $name)
	{
		$conversation = $this->create([
			'name' => empty($name) ? 'Pamiršai įrašyti pokalbio pavadinimą' : ucwords($name),
			'is_private' => false
		]);

		$current_participants = $this->participants()->lists('id');
		$conversation->participants()->sync(array_merge($current_participants, $users));

		return $conversation;
	}

	public function addAdditionalParticipants(Array $users)
	{
		//$this->participants()->attach($users); cannot use this method due to SQL 2005
		$this->participants()->sync(array_merge($this->participants()->lists('id'), $users));
	}

	public static function findOrCreateBetween(\maze\User $user, \maze\User $other_user)
	{
		$user_participates = $user->privateConversations()->all();
		$other_user_partcipates = $other_user->privateConversations()->all();

		$static = new static;

		$shared_participations = collect(array_intersect($user_participates, $other_user_partcipates));
		return $shared_participations->isEmpty() ? $static->createBetween($user, $other_user) : $static->find($shared_participations->first());
	}

	public function createBetween(\maze\User $user, \maze\User $other_user)
	{
		$conversation = $this->create([
			'name' => 'Pokalbis tarp ' . $user->username . ' ir ' . $other_user->username,
			'is_private' => true
		]);

		$conversation->participants()->sync([$user->id, $other_user->id]);

		return $conversation;
		//$user->conversations()->attach($conversation->id);
		//$other_user->conversations()->attach($conversation->id);
	}

	public function scopeIgnoreGlobal($query)
	{
		return $query->where('id', '<>', 1);
	}

	public function scopeIsPrivate($query)
	{
		return $query->where('is_private', true);
	}

}