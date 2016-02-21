<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'github_id', 'status', 'enabled'
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];
}
