<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\VoteRequest;

use Illuminate\Http\Request;

use maze\Reply;
use maze\Vote;
use maze\Topic;

use Auth;

class VotesController extends Controller {

	public function vote(VoteRequest $request, $vote, $type, $id) {
		
		$user = Auth::user();

		if($type == 'tema')
		{
			$type = 'Topic';
			$_votable = Topic::findOrFail($id);
		}
		else
		{
			$type = 'Reply';
			$_votable = Reply::findOrFail($id);
		}

		$_vote = Vote::where('votable_type', $type)
				->where('votable_id', $id)
				->where('user_id', $user->id)
				->first();

		//Ištrinam visus balsus, jei netyčia susibugintų.
		if($_vote)
		{
			Vote::where('votable_type', $type)
				->where('votable_id', $id)
				->where('user_id', $user->id)
				->delete();

			if($_vote->is != $vote)
			{
				$created_vote = Vote::create([
					'user_id'		=> $user->id,
					'votable_type'	=> $type,
					'votable_id'	=> $id,
					'is'			=> $vote
				]);

				if($vote == 'upvote')
				{
					$_votable->increment('vote_count', 2);
					$_votable->user()->increment('karma_count', 2);
				}
				else
				{
					$_votable->decrement('vote_count', 2);
					$_votable->user()->decrement('karma_count', 2);
				}
			}
			else
			{
				if($vote == 'upvote')
				{
					$_votable->decrement('vote_count', 1);
					$_votable->user()->decrement('karma_count', 1);
				}
				else
				{
					$_votable->increment('vote_count', 1);
					$_votable->user()->increment('karma_count', 1);
				}
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

			if($vote == 'upvote')
			{
				$_votable->increment('vote_count', 1);
				$_votable->user()->increment('karma_count', 1);
			}
			else
			{
				$_votable->decrement('vote_count', 1);
				$_votable->user()->decrement('karma_count', 1);
			}
		}

		return response('success', 200);

	}

}
