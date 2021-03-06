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
use maze\Events\StatusWasCreated;
use maze\Events\StatusWasDeleted;
use maze\Events\StatusCommentWasCreated;
use maze\Events\StatusCommentWasDeleted;
use maze\Events\UserWasMentioned;
use maze\Status;
use maze\StatusComment;
use Auth;
use Markdown;
use maze\Mentions\Mention;
use maze\User;

class StatusesController extends Controller
{

    public function __construct()
    {
        $this->middleware('loggedIn');
    }

    public function show($id)
    {
        $status = Status::findOrFail($id);
        $user = $status->user;
        return view('status.show', compact('status', 'user'));
    }

    public function create(CreateStatus $request)
    {
        $mention = new Mention();

        $status = Status::create([
            'user_id'            => Auth::user()->id,
            'body'                => markdown($mention->parse($request->input('body'))),
            'body_original'        => $request->input('body'),
        ]);

        foreach ($mention->users as $user) {
            event(new UserWasMentioned($status, $user));
        }

        event(new StatusWasCreated($status, Auth::user()));

        flash()->success('Būsena sėkmingai atnaujinta!');
        return redirect()->route('user.profile', ['rodyti' => 'busenos-atnaujinimai']);
    }

    public function edit(EditStatus $request, $id)
    {
        $status = Status::findOrFail($id);
        $user = $status->user;
        return view('status.edit', compact('status', 'user'));
    }

    public function save(UpdateStatus $request)
    {
        $mention = new Mention();

        $status = Status::findOrFail($request->input('id'));
        $status->body_original  = $request->input('body');
        $status->edited_by        = Auth::user()->id;
        $status->body            = markdown($mention->parse($request->input('body')));
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

        event(new StatusWasDeleted($status, $status->user));

        flash()->success('Būsenos atnaujinimas sėkmingai ištrintas');
        return redirect()->route('user.show', $user->slug);
    }

    public function commentEdit(EditStatusComment $request, $id)
    {
        $comment = StatusComment::findOrFail($id);
        $user = Auth::user();

        return view('status.comment.edit', compact('comment', 'user'));
    }

    public function commentCreate(CreateStatusComment $request)
    {
        $data = $request->all();
        $mention = new Mention();

        $data['user_id']        = Auth::user()->id;
        $data['body_original']    = $data['body'];
        $data['body']            = markdown($mention->parse($data['body']));

        $status_comment = StatusComment::create($data);

        foreach ($mention->users as $user) {
            event(new UserWasMentioned($status_comment, $user));
        }

        event(new StatusCommentWasCreated($status_comment, Auth::user()));

        flash()->success('Komentaras sėkmingai sukurtas!');

        return redirect()->route('status.show', $data['status_id']);
    }

    public function commentDelete(DeleteStatusComment $request, $id)
    {
        $comment = StatusComment::findOrFail($id);
        $comment->delete($id);

        event(new StatusCommentWasDeleted($comment, $comment->user));

        flash()->success('Komentaras sėkmingai ištrintas!');

        return redirect()->route('status.show', $comment->status->id);
    }

    public function commentSave(UpdateStatusComment $request)
    {
        $data = $request->all();
        $mention = new Mention();

        $comment = StatusComment::findOrFail($data['id']);

        $comment->body_original = $data['body'];
        $comment->body            = markdown($mention->parse($data['body']));

        $comment->save();

        flash()->success('Komentaras sėkmingai atnaujintas!');

        return redirect()->route('status.show', $comment->status->id);
    }
}
