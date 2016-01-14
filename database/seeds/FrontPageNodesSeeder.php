<?php

use Illuminate\Database\Seeder;

use maze\FrontPageNode;

class FrontPageNodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            if($user->frontPageNodes()->isEmpty()) {
        		FrontPageNode::reset($user);
        	}
        }
    }
}
