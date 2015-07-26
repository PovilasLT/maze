<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\DeleteStatus;
use maze\Http\Requests\CreateStatus;
use maze\Http\Requests\UpdateStatus;
use maze\Http\Requests\EditStatus;

use maze\Http\Requests\CreateStatusComment;
use maze\Http\Requests\UpdateStatusComment;
use maze\Http\Requests\DeleteStatusComment;
use maze\Http\Requests\EditStatusComment;

use maze\Status;

use Auth;
use Markdown;

class StatusesController extends Controller {

	public function show($id)
	{
		$status = Status::findOrFail($id);
		$user = $status->user;
		return view('status.show', compact('status', 'user'));
	}

	public function create(CreateStatus $request) 
	{

		Status::create([
			'user_id' 			=> Auth::user()->id,
			'body'    			=> Markdown::convertToHtml($request->input('body')),
			'body_original'		=> $request->input('body'),
		]);

		flash()->success('Būsena sėkmingai atnaujinta!');
		return redirect()->route('user.profile');
	}

	public function edit(EditStatus $request, $id)
	{
		$status = Status::findOrFail($id);
		$user = $status->user;
		return view('status.edit', compact('status', 'user'));
	}

	public function save(UpdateStatus $request)
	{
		$status = Status::findOrFail($request->input('id'));
		$status->body_original  = $request->input('body');
		$status->edited_by 		= Auth::user()->id;
		$status->body 			= Markdown::convertToHtml($request->input('body'));
		$status->save();

		flash()->success('Būsenos atnaujinimas sėkmingai išsaugotas');

		return redirect()->route('status.show', $status->id);
	}

	public function delete(DeleteStatus $request, $id)
	{
		$status = Status::findOrFail($id);
		$user = $status->user;
		//Ištrina būsenos atnaujinimą.
		$status->delete();
		flash()->success('Būsenos atnaujinimas sėkmingai ištrintas');
		return redirect()->route('user.show', $user->slug);
	}

	public function commentEdit(EditStatusComment $request) {

	}

	public function commentCreate(CreateStatusComment $request) {

	}

	public function commentDelete(DeleteStatusComments $request) {

	}

	public function commentSave(UpdateStatusComment $request) {

	}

}