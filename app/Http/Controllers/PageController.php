<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;

use Illuminate\Http\Request;

class PageController extends Controller {

	public function index()
	{
		$topics = Topic::frontPage();
		return view('pages.home', compact('topics'));
	}

	public function team()
	{
		
	}

	public function about()
	{

	}

}