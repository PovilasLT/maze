<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Vote;
use maze\Http\Requests\;

use Illuminate\Http\Request;

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

		$vote = Vote::where('is', $vote)->where('votable_type', $type)->where('votable_id', $id)->first();

		//Ištrinam prieš tai buvusį balsą
		if($vote)
		{
			$vote->delete();
		}

		Vote::create([
			'user_id'		=> $user->id,
			'votable_type'	=> $type,
			'votable_id'	=> $id,
			'is'			=> $vote
		]);


	}

}
