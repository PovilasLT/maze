<?php

namespace maze\Http\Controllers\Twitch;

use maze\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('twitch.pages.index');
    }
}
