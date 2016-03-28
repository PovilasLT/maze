<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserSecrets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(User::all() as $user) {
            $secret = str_random(50).$user->id;
            while(User::where('secret', $secret)->count())
            {
                $secret = str_random(50).$user->id;
            }
            $user->secret = $secret;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
