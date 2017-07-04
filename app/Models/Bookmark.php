<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{

    protected $fillable = [
        'event_id',
        'client_id'
    ];

    
}
