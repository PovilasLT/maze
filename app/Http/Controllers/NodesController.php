<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use Illuminate\Http\Request;
use maze\Node;
use maze\Topic;

class NodesController extends Controller {
	/**
	 * Sukuria naują skiltį.
	 *
	 * @return Response
	 */
	public function store(CreateNode $request)
	{
		Node::create($request->all());
		return redirect()->back();
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
			$topics = $node->topics();
		}
		else
		{
			$nodes = Node::where('parent_node', $node->id)->lists('id');
			$topics = Topic::whereIn('node_id', $nodes);
		}

		if($sort == 'populiariausi' || !$sort)
		{
			$topics = $topics->pinnedLocal()->popular();
		}
		else
		{
			$topics->pinnedLocal()->latest();
		}

		$topics = $topics->paginate(20);
		
		return view('node.show', compact('node', 'topics', 'sort'));
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
