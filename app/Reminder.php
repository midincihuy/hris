<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'to',
        'cc',
        'subject',
        'message',
        'status',
        'sent_time',
    ];

    protected $casts = [
        'message' => 'array',
    ];
}
