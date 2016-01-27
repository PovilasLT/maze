<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

class ApiPageController extends Controller
{

    public function popular()
    {
        $topics = Topic::frontPage("populiariausi");
        return response()->json($topics);
    }

    public function newest()
    {
         $topics = Topic::frontPage("naujausi");
        return response()->json($topics);
    }

}
