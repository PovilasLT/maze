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
        	if(empty($user->frontPageNodes())) {
        		FrontPageNode::reset($user);
        	}
        }
    }
}
