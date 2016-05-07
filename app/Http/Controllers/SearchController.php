<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;
use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\User;
use maze\Reply;
use maze\Topic;
use maze\Status;
use maze\Streamer;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function results(Request $request)
    {
        $type = $request->input('type');
        $query = $request->input('query');

        if ($type == 'user') {
            $results = User::where('username', 'LIKE', '%'.$query.'%')->paginate(20);
        } elseif ($type == 'reply') {
            $results = Reply::where('body_original', 'LIKE', '%'.$query.'%')->paginate(20);
        } elseif ($type == 'topic') {
            $results = Topic::where('body_original', 'LIKE', '%'.$query.'%')->paginate(20);
        } elseif ($type == 'status') {
            $results = Status::where('body_original', 'LIKE', '%'.$query.'%')->paginate(20);
        } elseif ($type == 'stream') {
            $results = Streamer::where('twitch', 'LIKE', '%'.$query.'%')->paginate(20);
        }

        return view('search.results', compact('type', 'query', 'results'));
    }
}
