<?php namespace maze\Http\Controllers;

use maze\Http\Requests;
use maze\Http\Requests\DeleteStatus;
use maze\Http\Requests\CreateStatus;
use Auth;
use Markdown;

use maze\Status;

class StatusesController extends Controller {

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

	}

	public function update(UpdateStatus $request)
	{

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

}