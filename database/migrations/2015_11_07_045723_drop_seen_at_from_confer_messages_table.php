<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSeenAtFromConferMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confer_messages', function(Blueprint $table)
        {
            $table->dropColumn('seen_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confer_messages', function(Blueprint $table)
        {
            $table->timestamp('seen_at');
        });
    }
}
