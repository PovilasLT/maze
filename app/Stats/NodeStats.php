<?php namespace maze\Stats;

use maze\Node;
use maze\Reply;
use maze\Topic;
use Cache;

class NodeStats extends Stats
{
    private $remember_for = 5; //minutes
    public $replies = 0;
    public $topics = 0;

    public function __construct(Node $node)
    {
        $this->replies = $this->thousandsFormat($this->totalRelies($node));
        $this->topics = $this->thousandsFormat($this->totalTopics($node));
    }

    private function totalRelies($node)
    {
        return Cache::remember($node->id.'_total_replies', $this->remember_for, function () use ($node) {
            $topics = $node->topics()->lists('id');
            return Reply::whereIn('topic_id', $topics)->count();
        });
    }

    private function totalTopics($node)
    {
        return Cache::remember($node->id.'_total_topics', $this->remember_for, function () use ($node) {
            $topics = $node->topics()->lists('id');
            return Topic::whereIn('id', $topics)->count();
        });
    }
}
