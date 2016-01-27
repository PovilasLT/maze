<?php namespace maze;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $visible = [
		'id',
		'name',
		'color',
	];
}