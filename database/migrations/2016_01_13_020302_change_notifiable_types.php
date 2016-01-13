<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use maze\Notification;

class ChangeNotifiableTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $notifications = Notification::all();
        foreach($notifications as $notification)
        {
            $notification->update(['object_type' => studly_case($notification->object_type)]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $notifications = Notification::all();
        foreach($notifications as $notification)
        {
            $notification->update(['object_type' => snake_case($notification->object_type)]);
        }
    }
}
