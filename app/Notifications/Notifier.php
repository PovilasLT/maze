<?php namespace maze\Notifications;

use maze\Notification;
use maze\Events\UserWasNotified;
use Auth;

class Notifier {
	public static function notify($type, $object, $receiver)
	{

		$user = Auth::user();

		$notification = Notification::create([
			'user_id'		=> $receiver->id,
			'from_id'		=> $user->id,
			'object_type'	=> $type,
			'object_id'		=> $object->id,
		]);


		//jeigu notificationas ne mums patiems, padidinam notification count
		//ir triggerinam send mail eventa.
		if($receiver->id != $user->id)
		{
			$receiver->increment('notification_count');

			if($receiver->email_replies)
			{
				event(new UserWasNotified($object, $receiver));
			}

		}

		return $notification;

	}
}