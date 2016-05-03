<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use maze\Streamer;

class TvStreamerController extends Controller
{
    public function show($twitch) {
        $streamer = Streamer::where('twitch', $twitch)->firstOrFail();
        $related = Streamer::sorted()->where('id', '<>', $streamer->id)->where('game', $streamer->game)->take(4)->get();
        return view('streamer.show', compact('streamer', 'related'));
    }

    public function all(Request $request) {
        $current_game = false;
        $streamers = Streamer::sorted();
        $sidebar = true;

        if($request->has('zaidimas')) {
            $current_game = $request->get('zaidimas');
            $streamers->where('game', 'LIKE', '%'.e($current_game).'%');
        }

        $streamers = $streamers->paginate(24);
        $games = Streamer::distinct()->select('game')->groupBy('game')->lists('game');
        return view('streamer.list', compact('streamers', 'games', 'current_game', 'sidebar'));
    }
}
