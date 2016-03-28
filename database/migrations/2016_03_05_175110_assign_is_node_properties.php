<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignIsNodeProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $market = [
            14,
            19,
            23,
            25,
            21,
            27,
            29,
            31,
            33,
            35,
            37,
            39,
            41,
            43,
            45,
            47,
            64,
            65,
            66,

        ];
        $nodes = maze\Node::all();
        foreach($nodes as $node)
        {
            if(in_array($node->id, config('app.front_page_nodes')))
            {
                $node->is_frontpage = true;
            }

            if(in_array($node->id, $market))
            {
                $node->is_market = true;
            }

            $node->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $nodes = maze\Node::all();
        foreach($nodes as $node)
        {
            $node->is_frontpage = 0;
            $node->is_market = 0;
            $node->save();
        }
    }
}
