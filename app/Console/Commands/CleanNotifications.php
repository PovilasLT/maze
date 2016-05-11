<?php

namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use DB;

class CleanNotifications extends Command implements SelfHandling
{

    protected $name = 'notifications:clean';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        DB::raw("DELETE FROM notifications WHERE object_type = 'GameServer' AND NOT EXISTS (SELECT id FROM servers WHERE servers.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'Mention' AND NOT EXISTS (SELECT id FROM mentions WHERE mentions.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'Reply' AND NOT EXISTS (SELECT id FROM replies WHERE replies.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'ServerComment' AND NOT EXISTS (SELECT id FROM server_comments WHERE server_comments.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'Status' AND NOT EXISTS (SELECT id FROM statuses WHERE statuses.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'StatusComment' AND NOT EXISTS (SELECT id FROM status_comments WHERE status_comments.id = notifications.object_id)");
        DB::raw("DELETE FROM notifications WHERE object_type = 'Topic' AND NOT EXISTS (SELECT id FROM topics WHERE topics.id = notifications.object_id)");
    }
}
