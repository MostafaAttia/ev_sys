<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{

    protected $hidden = [
        'pivot'
    ];


    public function activities()
    {
        return $this->belongsToMany(\App\Models\Event::class, 'activity_weekdays', 'weekday_id', 'event_id');
    }

}