<?php

use Illuminate\Database\Seeder;

class TopicTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('topic_types')->insert([
        	[
	        	'id'		=> 1,
	        	'name'		=> 'Diskusija',
	        	'icon'		=> 'fa fa-comments-o fa-fw',
	        	'color'	=> 'peter-river',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 2,
	        	'name'		=> 'Klausimas',
	        	'icon'		=> 'fa fa-question fa-fw',
	        	'color'	=> 'orange',
	        	'is_selflock' => 1,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 3,
	        	'name'		=> 'Konkursas',
	        	'icon'		=> 'fa fa-trophy fa-fw',
	        	'color'	=> 'dark-red',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 4,
	        	'name'		=> 'Video',
	        	'icon'		=> 'fa fa-youtube-play fa-fw',
	        	'color'	=> 'youtube-red',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 5,
	        	'name'		=> 'Stream',
	        	'icon'		=> 'fa fa-twitch fa-fw',
	        	'color'	=> 'twitch-purple',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 6,
	        	'name'		=> 'Kviečiu Žaisti',
	        	'icon'		=> 'fa fa-gamepad fa-fw',
	        	'color'	=> 'turquoise',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 7,
	        	'name'		=> 'Pristatymas',
	        	'icon'		=> 'fa fa-star fa-fw',
	        	'color'	=> 'grey',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 0

        	],
        	[
        		'id'		=> 215,
	        	'name'		=> 'Pranešimas',
	        	'icon'		=> 'fa fa-exclamation fa-fw',
	        	'color'	=> 'emerald',
	        	'is_selflock' => 0,
	        	'is_admin'	=> 1

        	],
        ]);
    }
}
