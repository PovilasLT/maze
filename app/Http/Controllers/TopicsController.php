<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Topic;
use maze\Node;
use maze\Http\Requests\CreateTopic;

use Illuminate\Http\Request;

class TopicsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$nodes = Node::parents();
		return view('topic.create', compact('nodes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTopic $request)
	{
		$topic = Topic::create($request->all());

		//TODO: Slug generavimas.
		$topic->slug = '123';
		$topic->save();

		flash()->success('Tema sėkmingai sukurta!');
		//grazinam useri i sukurta topic'a
		return redirect()->route('topic.show', ['slug' => $topic->slug]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$topic = Topic::where('slug', $slug)->firstOrFail();
		
		//padidina view counteri.
		$topic->increment('view_count');

		return view('topic.show', compact('topic'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(EditTopic $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateTopic $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(DeleteTopic $request, $slug)
	{
		$topic = Topic::where('slug', $slug)->first();
		$topic->delete();

		flash()->success('Tema sėkmingai ištrinta');

		return redirect()->route('node.show', ['slug' => $topic->node->slug]);
	}

}
