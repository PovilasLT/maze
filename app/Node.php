<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\Node;

class Node extends Model {

	public function topics() {
		return $this->hasMany('maze\Topic');
	}

	public function children() {
		return $this->hasMany('maze\Node', 'parent_node')->orderBy('order', 'ASC');
	}

	public static function parents() {
		return Node::whereNull('parent_node')->orderBy('order', 'ASC')->get();
	}

}
