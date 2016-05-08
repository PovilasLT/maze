<?php namespace maze\Http\Controllers;

use maze\Http\Controllers\Controller;
use maze\Http\Requests\TopicRequest;
use Illuminate\Http\Request;
use maze\Events\TopicWasCreated;
use maze\Events\TopicWasDeleted;
use maze\Events\UserWasMentioned;
use maze\Topic;
use maze\Node;
use maze\TopicType;
use Auth;
use Markdown;
use maze\Mentions\Mention;

class TopicsController extends Controller
{
    public function create(Request $request)
    {
        $nodes = Node::parents();
        $node_id = false;
        $topic_types = TopicType::get();
        if ($request->has('skiltis')) {
            $node_id = $request->input('skiltis');
        }

        return view('topic.create', compact('nodes', 'node_id', 'topic_types'));
    }
    public function store(TopicRequest $request)
    {
        $data        = $request->all();
        $mention     = new Mention();

        $data['body_original']    = $data['body'];
        $data['body']             = $mention->parse($data['body']);
        $data['body']             = markdown($data['body']);
        $data['user_id']          = $request->user()->id;

        $topic = Topic::create($data);
        $user = $request->user();

        foreach ($mention->users as $user) {
            event(new UserWasMentioned($topic, $user));
        }

        event(new TopicWasCreated($topic, $user));
        
        flash()->success('Tema sėkmingai sukurta!');
        return redirect()->route('topic.show', ['slug' => $topic->slug]);
    }
    public function show(Topic $topic)
    {
        if ($topic->node->parent_node) {
            $expandable = $topic->node->parent_node;
        } else {
            $expandable = $topic->node_id;
        }

        $node = $topic->node;
        
        if (Auth::check()) {
            $replies = $topic->replies()->lists('id');
            Auth::user()->notifications()->whereIn('object_id', $replies)->where('object_type', 'reply')->update(['is_read' => true]);
        }
        
        $topic->increment('view_count');

        return view('topic.show', compact('topic', 'expandable', 'node'));
    }
    public function edit(TopicRequest $request, Topic $topic)
    {
        $nodes = Node::parents();
        $topic_types = TopicType::get();
        return view('topic.edit', compact('topic', 'nodes', 'topic_types'));
    }
    public function update(TopicRequest $request, Topic $topic)
    {
        $data        = $request->all();
        $mention    = new Mention();

        $topic->title            = $data['title'];
        $topic->body_original    = $data['body'];
        $data['body']            = $mention->parse($data['body']);
        $topic->body             = markdown($data['body']);
        $topic->type_id          = $data['type_id'];
        $topic->node_id          = $data['node_id'];

        $topic->save();

        flash()->success('Tema sėkmingai atnaujinta!');
        return redirect()->route('topic.show', ['slug' => $topic->slug]);
    }
    public function destroy(TopicRequest $request, Topic $topic)
    {
        $topic->delete();
        event(new TopicWasDeleted($topic, $request->user()));

        flash()->success('Tema sėkmingai ištrinta!');

        return redirect()->route('node.show', ['slug' => $topic->node->slug]);
    }

    public function bump(Topic $topic)
    {
        $topic->bump();
        flash()->success('Tema sėkmingai pakelta!');

        return redirect()->back();
    }

    public function pinGlobal(Topic $topic)
    {
        $topic->pinGlobal();
        flash()->success('Tema sėkmingai prisegta!');

        return redirect()->back();
    }

    public function pinLocal(Topic $topic)
    {
        $topic->pinLocal();
        flash()->success('Tema sėkmingai prisegta!');

        return redirect()->back();
    }

    public function unpin(Topic $topic)
    {
        $topic->unpin();
        flash()->success('Tema sėkmingai atsegta!');

        return redirect()->back();
    }

    public function unsink(Topic $topic)
    {
        $topic->unsink();
        flash()->success('Tema sėkmingai atgaivinta!');

        return redirect()->back();
    }

    public function sink(Topic $topic)
    {
        $topic->sink();
        flash()->success('Tema sėkmingai nuskandinta!');

        return redirect()->back();
    }

    public function lock(Topic $topic)
    {
        if ($topic->is_blocked) {
            $topic->unlock();
            flash()->success('Tema sėkmingai atrakinta!');
        } else {
            $topic->lock();
            flash()->success('Tema sėkmingai užraktinta');
        }

        return redirect()->back();
    }
}
