<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\Node;

class Node extends Model {

	public function topics() {
		return $this->hasMany('maze\Topic');
	}

	public function parent() {
		return $this->belongsTo('maze\Node', 'parent_node');
	}

	public function children() {
		return $this->hasMany('maze\Node', 'parent_node')->orderBy('order', 'ASC');
	}

	public static function parents() {
		return Node::whereNull('parent_node')->orderBy('order', 'ASC')->get();
	}

	//grazina slug'a, jei jis neegzistuoja
	public function getSlugAttribute($value)
	{
		if($value)
		{
			return $value;
		}
		else
		{
			$slug = str_slug($this->name, '-');
			$this->attributes['slug'] = $slug;
			$this->save();
			return $slug;
		}
	}

}
