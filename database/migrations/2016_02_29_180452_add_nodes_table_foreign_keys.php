<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNodesTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nodes', function($table) {
            $table->integer('parent_node')->unsigned()->change();
            $table->foreign('parent_node')->references('id')->on('nodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nodes', function($table) {
            $table->dropForeign('nodes_parent_node_foreign');
        });    
        Schema::table('nodes', function($table) {
            $table->smallInteger('parent_node')->change();
        });  
    }
}
