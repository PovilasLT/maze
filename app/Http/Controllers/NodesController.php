<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\CreateNode;
use maze\Http\Controllers\Controller;


use maze\Events\NodeWasCreated;
use Illuminate\Http\Request;
use maze\Node;
use maze\Topic;
use Auth;

class NodesController extends Controller {


	public function create()
	{
		$nodes = Node::parents();
		return view('node.create', compact('nodes'));	
	}

	/**
	 * Sukuria naują skiltį.
	 *

	 */
	public function store(CreateNode $request)
	{
		$parentnode = $request->parentNode;
		if($parentnode)
			$parentnode = $parentnode->id;
		else
			$parentnode = null;


		$description = $request->input('description');
		$name = $request->input('name');


		$node = Node::create([
				'name'			=> $name,
				'description'	=> $description,
				'parent_node'	=> $parentnode
			]);

		event(new NodeWasCreated($node, Auth::user()));

		return redirect()->route('node.show', $node->slug);
	}

	/**
	 * Rodo skiltį.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $slug) {
		
		$sort = $request->input('rodyti');

		$node = Node::where('slug', $slug)->firstOrFail();
		if($node->parent_node)
		{
			$topics = $node->topics()->withReplies();
			$expandable = $node->parent_node;
		}
		else
		{
			$nodes = Node::where('parent_node', $node->id)->lists('id')->all();
			$topics = Topic::whereIn('node_id', $nodes)->withReplies();
			$expandable = $node->id;
		}

		if($sort == 'populiariausi' || !$sort)
		{
			$topics = $topics->pinnedLocal()->popular()->withReplies();
		}
		else if($sort == 'mano-turinys')
		{
			$topics = $topics->pinnedLocal()->user(Auth::user())->latestPost()->withReplies();
		}
		else if($sort == 'naujausi-pranesimai')
		{
			$topics = $topics->pinnedLocal()->latestPost()->withReplies();
		}
		else
		{
			$topics->pinnedLocal()->latest()->withReplies();
		}

		$topics = $topics->paginate(20);
		
		return view('node.show', compact('node', 'topics', 'sort', 'expandable'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
