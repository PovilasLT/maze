<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

use Illuminate\Http\Request;

use Markdown;

class PageController extends Controller {

	public function index(Request $request)
	{
		$sort = $request->input('rodyti');
		$topics = Topic::frontPage($sort);
		return view('pages.home', compact('topics', 'sort'));
	}

	public function team()
	{
		
	}

	public function about()
	{

	}

}