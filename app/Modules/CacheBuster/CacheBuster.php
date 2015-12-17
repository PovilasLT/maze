<?php namespace maze\Modules\CacheBuster;

use maze\User;
use Cache;

class CacheBuster {
	public function __construct() {
		User::created(function($user) {
			Cache::forget('users');
		});
		User::updated(function($user) {
			Cache::forget('users');
		});
	}
}