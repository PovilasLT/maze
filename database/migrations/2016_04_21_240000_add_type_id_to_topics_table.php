<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
        });
        DB::table('topics')
            ->where('type', 0)
            ->update(['type_id' => 1]);

        DB::statement('update topics set type_id = type where type != 0');

        Schema::table('topics', function($table) {
            $table->foreign('type_id')->references('id')->on('topic_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('topics')
            ->where('type_id', '=', '1')
            ->update(['type' => 0]);

        DB::statement('update topics set type = type_id where type_id != 1');
        Schema::table('topics', function($table) {
            $table->dropForeign('topics_type_id_foreign');
        });
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('type_id')->default(1);
        });


    }
}
