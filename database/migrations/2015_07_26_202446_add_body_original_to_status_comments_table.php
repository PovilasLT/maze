<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBodyOriginalToStatusCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_comments', function(Blueprint $table)
        {
            $table->text('body_original');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_comments', function(Blueprint $table)
        {
            $table->dropColumn('body_original');
        });
    }
}
