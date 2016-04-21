<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateTopicTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('topic_types')->insert([
            [
                'id'        => 1,
                'name'      => 'Diskusija',
                'icon'      => 'fa fa-comments-o fa-fw',
                'label_style'   => 'label-diskusija',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0

            ],
            [
                'id'        => 2,
                'name'      => 'Klausimas',
                'icon'      => 'fa fa-question fa-fw',
                'label_style'   => 'label-klausimas',
                'is_selflock' => 1,
                'is_admin'  => 0,
                'is_ad'     => 0
            ],
            [
                'id'        => 3,
                'name'      => 'Konkursas',
                'icon'      => 'fa fa-trophy fa-fw',
                'label_style'=> 'label-apklausa',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0

            ],
            [
                'id'        => 4,
                'name'      => 'Video',
                'icon'      => 'fa fa-youtube-play fa-fw',
                'label_style'=> 'label-video',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0

            ],
            [
                'id'        => 5,
                'name'      => 'Stream',
                'icon'      => 'fa fa-twitch fa-fw',
                'label_style'=> 'label-stream',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0

            ],
            [
                'id'        => 6,
                'name'      => 'Kviečiu Žaisti',
                'icon'      => 'fa fa-gamepad fa-fw',
                'label_style'=> 'label-play',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0
            ],
            [
                'id'        => 7,
                'name'      => 'Pristatymas',
                'icon'      => 'fa fa-star fa-fw',
                'label_style'=> 'label-spam',
                'is_selflock' => 0,
                'is_admin'  => 0,
                'is_ad'     => 0

            ],
            [
                'id'        => 215,
                'name'      => 'Pranešimas',
                'icon'      => 'fa fa-exclamation fa-fw',
                'label_style'=> 'label-pranesimas',
                'is_selflock' => 0,
                'is_admin'  => 1,
                'is_ad'     => 0

            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('topic_types')->delete();
    }
}
