<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitiZaidimaiNode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('nodes')->insert([
            'name'          => 'Kiti Žaidimai',
            'description'   => 'Tema apie žiadimą netelpa kitur? Jos vieta čia!',
            'parent_node'   => '10',
            'order'         => '0'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('nodes')->where('name', '=', 'Kiti Žaidimai')->delete();
    }
}
