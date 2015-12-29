<?php namespace maze\Notifications;

use maze\Notification;
use Auth;

class NotificationFactory {
	public static function create($type, $object, $receiver)
	{
		$user = Auth::user();

		Notification::create([
			'user_id'		=> $receiver->id,
			'from_id'		=> $user->id,
			'object_type'	=> $type,
			'object_id'		=> $object->id,
		]);
	}
}