<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\VoteRequest;

use Illuminate\Http\Request;

use maze\Reply;
use maze\Vote;
use maze\Topic;
use maze\GameServer;
use maze\ServerComment;

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
		else if($type == 'pranesimas')
		{
			$type = 'Reply';
			$_votable = Reply::findOrFail($id);
		}
		else if($type == 'serveris')
		{
			$type = 'GameServer';
			$_votable = GameServer::findOrFail($id);
		}
		else if($type == 'serverio-komentaras')
		{
			$type = 'ServerComment';
			$_votable = ServerComment::findOrFail($id);
		}

		$_vote = Vote::where('votable_type', $type)
				->where('votable_id', $id)
				->where('user_id', $user->id)
				->first();

		// Useris jau yra prabalsavęs už šitą entity
		if($_vote)
		{
			// Trinam lauk seną vote
			Vote::where('votable_type', $type)
				->where('votable_id', $id)
				->where('user_id', $user->id)
				->delete();

			// Jeigu buvo up, o dabar yra down, 
			// arba buvo down, o dabar yra up
			if($_vote->is != $vote)
			{
				// Sukuriam naują vote
				$created_vote = Vote::create([
					'user_id'		=> $user->id,
					'votable_type'	=> $type,
					'votable_id'	=> $id,
					'is'			=> $vote
				]);

				// Kangi seną vote ištrynėm, bet entity liko su senu vote,
				// reikia duoti priešingą vote dvigubai.
				// Jeigu entity buvo +1, tai davus -1*2 entity taps -1,
				// o duomenų bazėje vistiek bus tik vienas -1 vote.
				if($vote == 'upvote')
				{
					event(new UpVoted($_votable, $created_vote, $_votable->user, true));
				}
				else
				{
					event(new DownVoted($_votable, $created_vote, $_votable->user, true));
				}
			}
			else
			{
				// Jeigu vote tipai vienodi, tiek seno tiek naujo,
				// tiesiog atšaukiam seną vote

				// Paduodami seno vote model objektą, padarom fake vote 
				// kuris yra priešingas negu paspaudėm, todėl jeigu 2 kartus
				// paspausi up, gausis
				// up -- created, +1 entity
				// down -- faked (already delete), -1 entity
				// todėl gale lieka entity su +0, ir pačio vote duomenų bazėje nebebūna.
				if($vote == 'upvote')
				{
					event(new DownVoted($_votable, $_vote, $_votable->user, false));
				}
				else
				{
					event(new UpVoted($_votable, $_vote, $_votable->user, false));
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
