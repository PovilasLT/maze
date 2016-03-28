<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsColumnsToNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->boolean('is_frontpage')->default(0);
            $table->boolean('is_market')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->dropColumn('is_frontpage');
            $table->dropColumn('is_market');
        });
    }
}
