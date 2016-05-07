<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

class PasswordReminder extends Model
{
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}
