<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsReadToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->boolean('is_read')->default(1)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }
}
