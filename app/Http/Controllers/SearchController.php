<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use maze\User;
use maze\Reply;
use maze\Topic;
use maze\Status;

class SearchController extends Controller
{
    public function index() {
        return view('search.index');
    }

    public function results(Request $request) {

        $type = $request->input('type');
        $query = $request->input('query');

        if($type == 'user')
        {
            $results = User::where('username', 'LIKE', '%'.$query.'%')->paginate(20);
        }
        elseif($type == 'reply')
        {
            $results = Reply::where('body_original', 'LIKE', '%'.$query.'%');
        }
        elseif($type == 'topic')
        {
            $results = Topic::where('body_original', 'LIKE', '%'.$query.'%');
        }
        elseif($type == 'status')
        {
            $results = Status::where('body_original', 'LIKE', '%'.$query.'%');
        }

        // $results->paginate(20);

        return view('search.results', compact('type', 'query', 'results'));
    }
}
