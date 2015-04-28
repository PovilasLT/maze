<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNodesToNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Eloquent::unguard();

		$node = Node::create([
			'name'	=> 'GTA V',
			'order'	=> 6
		]);

		Node::create([
			'name'	=> 'Bendros Diskusijos',
			'slug'	=> 'gta-5-diskusijos',
			'description'	=> 'Bendros GTA V diskusijos. Laukiama viskas, kas susiję su GTA V.',
			'order'			=> 0,
			'parent_node'	=> $node->id,
		]);

		Node::create([
			'name'	=> 'Crews',
			'slug'	=> 'gta-5-crews',
			'description'	=> 'GTA V gaujų diskusijos (Crews)',
			'order'			=> 0,
			'parent_node'	=> $node->id,
		]);
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
