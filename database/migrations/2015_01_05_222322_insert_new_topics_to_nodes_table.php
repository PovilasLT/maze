<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class InsertNewTopicsToNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $nodes = [
            'name'          => 'Similiatorių Žaidimai',
            'slug'          => 'simuliatoriu-zaidimai',
            'parent_node'   => 10,
            'description'   => 'The Sims, SimCity, Farming Simulator ir kiti similiatorių žaidimai.',
        ];
        DB::table('nodes')->insert( $nodes );

        $nodes = [
            'name'          => 'Telefonų Žaidimai',
            'slug'          => 'telefonu-zaidimai',
            'parent_node'   => 10,
            'description'   => 'Diskusijos apie žaidimus mobiliesiems prietaisams. Clash of Clans, Hearthstone ir t.t.',
        ];
        DB::table('nodes')->insert( $nodes );

        $nodes = [
            'name'          => 'Naršykliniai Žaidimai',
            'slug'          => 'narsykliniai-zaidimai',
            'parent_node'   => 10,
            'description'   => 'Diskusijos apie žaidimus skirtus naršyklėms',
        ];
        DB::table('nodes')->insert( $nodes );

        $nodes = [
            'name'          => 'Klaidos',
            'slug'          => 'klaidos',
            'parent_node'   => 1,
            'description'   => 'Skiltis skirta pranešti apie įvairias portale rastas klaidas.',
        ];
        DB::table('nodes')->insert( $nodes );

        $nodes = [
            'name'          => 'Viskas ir Nieko',
        ];

        $id = DB::table('nodes')->insertGetId( $nodes );

        $nodes = [
            'name'          => 'Sveikinimai ir Prisistatymai',
            'slug'          => 'sveikinimai-ir-prisistatymai',
            'parent_node'   => $id,
            'description'   => 'Skiltis skirta prisistatyti ir papasakoti Maze bendruomenei apie save.',
        ];
        DB::table('nodes')->insertGetId( $nodes );

        $nodes = [
            'name'          => 'Apie Viską',
            'slug'          => 'apie-viska',
            'parent_node'   => $id,
            'description'   => 'Viskas kas netilpo niekur kitur į kitas skiltis.',
        ];
        DB::table('nodes')->insertGetId( $nodes );

        $nodes = [
            'name'          => 'Įdomios Nuorodos',
            'slug'          => 'idomios-nuorodos',
            'parent_node'   => $id,
            'description'   => 'Radai juokingą video, kuriuo norėtum pasidalinti? Pirmyn!',
        ];
        DB::table('nodes')->insertGetId( $nodes );
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
