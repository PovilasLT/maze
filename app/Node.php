<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\Node;
use Cache;
use Stringy\StaticStringy as S;

class Node extends Model {

	protected $appends = [
		'parent'
	];

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

	public function getSlugAttribute($value)
	{
		if( ! $value)
		{
			$value = S::slugify($this->name);

			$nodes = Node::where('slug', $value);

			if($nodes->count() > 0)
			{
				$value = $this->id . '-' . $value;
				$this->slug = $value;

				$this->save();

				return $value;
			}
			else {
				$this->slug = $value;

				$this->save();

				return $value;
			}
		}
		else {
			return $value;
		}
	}

	public static function frontPageNodes() 
	{	
		$nodes = Cache::rememberForever('frontpage_nodes', function() {
			return self::where('is_frontpage', true)->lists('id');
		});
		return $nodes;
	}

	public static function marketNodes()
	{
		$nodes = Cache::rememberForever('market_nodes', function() {
			return self::where('is_market', true)->lists('id');
		});
		return $nodes;
	}

}
