<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

use Config;

class FrontPageNode extends Model
{
    protected $table = 'front_page_nodes';
    protected $fillable = ['user_id', 'node_id'];

    public static function reset(User $user) {
        // Just in case
        self::where('user_id', $user->id)->delete();

        $nodes = [];

        // Priskiriam default subscribe kategorijas
        foreach(Config::get('app.front_page_nodes') as $node) {
            $nodes [] = [
                'user_id' => $user->id,
                'node_id' => $node
            ];
        }
        self::insert($nodes);
    }

    public function node() {
    	return $this->belongsTo('maze\Node');
    }
}
