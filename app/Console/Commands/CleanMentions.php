<?php

namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use DB;

class CleanMentions extends Command implements SelfHandling
{

    protected $name = 'mentions:clean';

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
        $total = DB::delete("DELETE FROM mentions WHERE object_type = 'GameServer' AND NOT EXISTS (SELECT id FROM servers WHERE servers.id = mentions.object_id)");
        $total += DB::delete("DELETE FROM mentions WHERE object_type = 'Reply' AND NOT EXISTS (SELECT id FROM replies WHERE replies.id = mentions.object_id)");
        $total += DB::delete("DELETE FROM mentions WHERE object_type = 'ServerComment' AND NOT EXISTS (SELECT id FROM server_comments WHERE server_comments.id = mentions.object_id)");
        $total += DB::delete("DELETE FROM mentions WHERE object_type = 'Status' AND NOT EXISTS (SELECT id FROM statuses WHERE statuses.id = mentions.object_id)");
        $total += DB::delete("DELETE FROM mentions WHERE object_type = 'StatusComment' AND NOT EXISTS (SELECT id FROM status_comments WHERE status_comments.id = mentions.object_id)");
        $total += DB::delete("DELETE FROM mentions WHERE object_type = 'Topic' AND NOT EXISTS (SELECT id FROM topics WHERE topics.id = mentions.object_id)");

        echo ("Deleted " + $total + " rows");
    }
}
