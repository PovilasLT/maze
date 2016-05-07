<?php

namespace maze\Http\Controllers;

use Illuminate\Http\Request;
use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\FrontPageNode;
use Auth;

class FrontPageNodesController extends Controller
{
    public function __construct()
    {
        $this->middleware('loggedIn');
    }

    public function toggle($id)
    {
        $user = Auth::user();
        $state = FrontPageNode::where('user_id', $user->id)->where('node_id', $id)->exists();

        if ($state) {
            FrontPageNode::where('user_id', $user->id)->where('node_id', $id)->delete();
        } else {
            FrontPageNode::firstOrNew([
                'user_id' => $user->id,
                'node_id' => $id
            ])->save();
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $node_id = $request->input('node_id');
        $state = $request->input('state');
        $user = Auth::user();

        if ($state == 'on') {
            FrontPageNode::firstOrNew([
                'user_id' => $user->id,
                'node_id' => $node_id
            ])->save();
        } else {
            FrontPageNode::where('user_id', $user->id)->where('node_id', $node_id)->delete();
        }
    }
}
