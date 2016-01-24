<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

use Illuminate\Http\Request;

use Markdown;

use Log;

use maze\Mention;

class PageController extends Controller {

	public function index(Request $request)
	{
		$sort = $request->input('rodyti');
		$topics = Topic::frontPage($sort);
		Log::debug("HEAD".$request->header('accept'));
		if($request->ajax())
		{
			Log::debug("Its ajax");
			$topics = Topic::with('user')->paginate(20);
			return response()->json($topics);
		}
		return view('pages.home', compact('topics', 'sort'));
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