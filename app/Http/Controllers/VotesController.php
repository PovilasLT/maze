<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\VoteRequest;

use Illuminate\Http\Request;

use maze\Reply;
use maze\Vote;
use maze\Topic;

use maze\Events\UpVoted;
use maze\Events\DownVoted;

use Auth;

class VotesController extends Controller {

	public function __construct()
	{
		$this->middleware('loggedIn');
		$this->middleware('UserCanVote');
	}

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

				//cancel old vote and give new vote
				if($vote == 'upvote')
				{
					event(new UpVoted($_votable, $created_vote , $_votable->user, true));
				}
				else
				{
					event(new DownVoted($_votable, $created_vote , $_votable->user, true));
				}
			}
			else
			{
				//cancel current vote
				if($vote == 'upvote')
				{
					event(new DownVoted($_votable, $_vote , $_votable->user, false));
				}
				else
				{
					event(new UpVoted($_votable, $_vote , $_votable->user, false));
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

			//just vote

			if($vote == 'upvote')
			{

				event(new UpVoted($_votable, $created_vote , $_votable->user, false));
			}
			else
			{
				event(new DownVoted($_votable, $created_vote , $_votable->user, false));
			}
		}

		return response('success', 200);

	}

}
