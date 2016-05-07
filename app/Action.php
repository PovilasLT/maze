<?php namespace maze;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'item_name',
        'item_id',
        'ip',
    ];
}
