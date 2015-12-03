<?php

namespace maze\Modules\Confer;

use Illuminate\Database\Eloquent\Model;
use maze\User;

class Message extends Model {
	
	protected $fillable = ['body', 'conversation_id', 'sender_id', 'type'];
	protected $table = 'confer_messages';
	protected $guarded = ['id'];
	protected $appends = ['html'];

	public $html;

	public function getHtmlAttribute() {
		return message_html($this);
	}

	/**
	 * Get the conversation the message belongs to
	 * 
	 * @return belongsTo
	 */
	public function conversation()
	{
		return $this->belongsTo('maze\Modules\Confer\Conversation', 'conversation_id');
	}

	/**
	 * Get the user who sent the message
	 * 
	 * @return belongsTo
	 */
	public function sender()
	{
		return $this->belongsTo('maze\User', 'sender_id');
	}

	public function getEventData($type = 'private')
	{
		return $type === 'global' ? ['conversation' => $this->conversation, 'message' => $this, 'html' => message_html($this), 'sender' => $this->sender] : ['conversation' => $this->conversation, 'message' => $this, 'html' => message_html($this), 'sender' => $this->sender];
	}

	public static function unread(User $user, Conversation $conversation = null) {
		$ids = \DB::table('seen_messages')->where('user_id', $user->id)->lists('message_id');

		if($conversation == null) {
			$conversations = \DB::table('confer_conversation_participants')->where('user_id', $user->id)->lists('conversation_id');

    		return self::whereNotIn('id', $ids)->where('sender_id', '!=', $user->id)->whereIn('conversation_id', $conversations)->get()->count();
    	}
    	else {
    		return self::whereNotIn('id', $ids)->where('sender_id', '!=', $user->id)->where('conversation_id', $conversation->id)->get()->count();
    	}
	}

	public function read(User $user) {
		if(empty(\DB::table('seen_messages')->where('user_id', $user->id)->where('message_id', $this->id)->get())) {
			\DB::table('seen_messages')->insert(['user_id' => $user->id, 'message_id' => $this->id, 'seen_at' => \Carbon\Carbon::now()]);
		}
	}

}