<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;
use Illuminate\Http\Request;
use Markdown;
use maze\Mention;
use Auth;

class PageController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->input('rodyti');
        $topics = Topic::frontPage($sort);
        if (Auth::check()) {
            $topics = $topics->withVotes();
        }
        $topics = $topics->with('node.parent')->paginate(20);
        $advertisements = Topic::market()->get();

        return view('pages.home', compact('topics', 'sort', 'advertisements'));
    }

    public function team()
    {
        return view('pages.team');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function rules()
    {
        return view('pages.rules');
    }

    public function knowledgebase()
    {
        return view('pages.knowledgebase');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
