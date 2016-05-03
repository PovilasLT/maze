<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Streamer;

use Cache;

class TvPagesController extends Controller
{
    
    public function home()
    {

        $streamers = Streamer::sorted()->take(9)->get();

        $featured = $streamers->shuffle()->random();

        return view('tv.pages.home', compact('streamers', 'featured'));
    }
}
