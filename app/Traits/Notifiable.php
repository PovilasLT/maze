<?php namespace maze\Traits;

use maze\Topic;
use maze\Reply;
use maze\Status;
use maze\StatusComment;
use maze\Follower;
use maze\Notification;
use maze\User;
use Event;
use Auth;
use Mail;

trait Notifiable {
	protected static function boot() {

		parent::boot();

		//Topic

		Topic::created(function($topic)
		{
			if($topic->node_id == 15)
			{
				$users = User::where('email_news', 1)->get();

				$data = [
					'title' => $topic->title,
					'body'  => $topic->body
				];

				foreach($users as $user)
				{
					Mail::queue('emails.news', $data, function($message) use($user, $topic)
					{
						$message->to($user->email)->subject('Maze Naujienos: '.utf8_urldecode($topic->title));
					});
				}
			}
		});



		Topic::created(function ($topic) {
			$user = Auth::user();
			Notification::create([
				'user_id' => Auth::user()->id,
				'from_id' => Auth::user()->id,
				'object_id' => $topic->id,
				'object_type' => 'topic',
			]);
			foreach ($user->followers as $follower) {
				Notification::create([
					'user_id' => $follower->follower_id,
					'from_id' => $user->id,
					'object_id' => $topic->id,
					'object_type' => 'topic',
				]);
				$user_follower = $follower->follower;
				$user_follower->increment('notification_count');
				$user_follower->save();
			}
		});

		Topic::deleting(function ($topic) {
			Notification::where('object_type', 'topic')->where('object_id', $topic->id)->delete();
		});

		//Reply

		Reply::created(function ($reply) {

			$user = Auth::user();

			Notification::create([
				'user_id' => $reply->topic->user_id,
				'from_id' => $reply->user_id,
				'object_id' => $reply->id,
				'object_type' => 'reply',
			]);

			if($user->id != $reply->topic->user->id) {
				$reply->topic->user->increment('notification_count');
				$reply->topic->user->save();
				$last_reply = $reply->topic->replies()->where('user_id', '<>', $user->id)->orderBy('created_at', 'desc')->first();
				if(!$last_reply || ($last_reply && $last_reply->created_at->diffInHours() > 24 && $reply->topic->user->email_replies))
				{
					$data = [
						'user'      => $reply->topic->user->username,
						'title'     => $reply->topic->title,
						'content'   => $reply->body,
						'slug'      => $reply->topic->slug,
						'id'        => $reply->topic->id
					];

					$topic = $reply->topic;
					$topic_user = $reply->topic->user;

					Mail::queue('emails.reply', $data, function($message) use($topic_user, $topic)
					{
						$message->to($topic_user->email)->subject('Naujas pranešimas temoje '.utf8_urldecode($topic->title));
					});
				}
			}

		//	foreach ($user->followers as $follower) {
		//		Notification::create([
		//			'user_id' => $follower->follower_id,
		//			'from_id' => $user->id,
		//			'object_id' => $reply->id,
		//			'object_type' => 'reply',
		//		]);
		//		$user_follower = $follower->follower;
		//		$user_follower->increment('notification_count');
		//		$user_follower->save();
		//	}

		});

		Reply::deleting(function ($reply) {
			Notification::where('object_type', 'reply')->where('object_id', $reply->id)->delete();
			Notification::where('object_type', 'mention')->where('object_id', $reply->id)->delete();
		});

		//Status

		Status::created(function ($status) {
			Notification::create([
				'user_id' => Auth::user()->id,
				'from_id' => Auth::user()->id,
				'object_id' => $status->id,
				'object_type' => 'status',
			]);
			$user = Auth::user();
			foreach ($user->followers as $follower) {
				Notification::create([
					'user_id' => $follower->follower_id,
					'from_id' => $user->id,
					'object_id' => $status->id,
					'object_type' => 'status',
				]);
				$user_follower = $follower->follower;
				$user_follower->increment('notification_count');
				$user_follower->save();
			}
		});

		Status::deleting(function ($status) {
			Notification::where('object_type', 'status')->where('object_id', $status->id)->delete();
		});

		//Status_Comments

		StatusComment::created(function ($status_comment) {
			$user = Auth::user();
			if($status_comment->user_id != $status_comment->status->user_id)
			{
				Notification::create([
					'user_id' => $status_comment->status->user_id,
					'from_id' => Auth::user()->id,
					'object_id' => $status_comment->id,
					'object_type' => 'status_comment',
				]);

				$status_comment->status->user->increment('notification_count');
				$status_comment->status->user->save();
			}
		});

		StatusComment::deleting(function ($status_comment) {
			Notification::where('object_type', 'status_comment')->where('object_id', $status_comment->id)->delete();
		});

		//Follow

		Follower::created(function ($follower) {
			Notification::create([
				'user_id' => $follower->user_id,
				'from_id' => Auth::user()->id,
				'object_id' => $follower->id,
				'object_type' => 'follow',
			]);
			$user = Auth::user();
			foreach ($user->followers as $follower_obj) {
				Notification::create([
					'user_id' => $follower_obj->follower_id,
					'from_id' => $user->id,
					'object_id' => $follower->id,
					'object_type' => 'follow',
				]);
				$user_follower = $follower_obj->follower;
				$user_follower->increment('notification_count');
				$user_follower->save();
			}
		});

		Follower::deleting(function ($follower) {
			Notification::where('object_type', 'follow')->where('object_id', $follower->id)->delete();
		});

		//Mention

		Event::listen('mention', function ($users, $post) {
			if (count($users)) {
				foreach ($users as $mentioned) {
					$user = Auth::user();
					Notification::create([
						'user_id' => $mentioned->id,
						'from_id' => $user->id,
						'object_id' => $post->id,
						'object_type' => 'mention',
					]);
					$mentioned->increment('notification_count');
					$mentioned->save();
				}
			}
		});

	}
}

