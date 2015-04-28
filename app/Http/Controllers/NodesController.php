<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Controllers\Controller;

use Illuminate\Http\Request;
use maze\Node;

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
	public function show($slug, $id) {
		$user = Node::find($id);
		if(!$user || !$user->slug == $slug)
		{
			abort(404);
			return false;
		}
		else
		{
			return view('nodes.show', compact($user));
		}
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
