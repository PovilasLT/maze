<?php

namespace maze\Listeners;

use maze\Events\NodeWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maze\User;
use DB;

class AddFrontPageNode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NodeWasCreated  $event
     * @return void
     */
    public function handle(NodeWasCreated $event)
    {
        $data = [];
        foreach (User::get() as $user) {
            $data [] = [
                'user_id'   => $user->id,
                'node_id'   => $event->node->id
            ];
        }
        DB::table('front_page_nodes')->insert($data);
    }
}
