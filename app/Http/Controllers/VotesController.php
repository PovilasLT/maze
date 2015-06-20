<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Vote;
use maze\Http\Requests\VoteRequest;

use Illuminate\Http\Request;

use Auth;
use Topic;

class VotesController extends Controller {

	public function vote(VoteRequest $request, $vote, $type, $id) {
		
		$user = Auth::user();

		if($type == 'tema')
		{
			$type = 'Topic';
		}
		else
		{
			$type = 'Reply';
		}

		$_vote = Vote::where('votable_type', $type)
				->where('votable_id', $id)
				->where('user_id', $user->id)
				->first();

		//Ištrinam prieš tai buvusį balsą
		if($_vote)
		{
			$_vote->delete();

			if($_vote->is != $vote)
			{
				$created_vote = Vote::create([
					'user_id'		=> $user->id,
					'votable_type'	=> $type,
					'votable_id'	=> $id,
					'is'			=> $vote
				]);
			}
		}
		else
		{
			$created_vote = Vote::create([
					'user_id'		=> $user->id,
					'votable_type'	=> $type,
					'votable_id'	=> $id,
					'is'			=> $vote
			]);
		}

		return response('success', 200);

	}

}
