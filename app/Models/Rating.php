<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating',
        'event_id',
        'client_id'
    ];

    /**
     * The client who own this rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(\App\Models\Client::class);
    }

     /**
     * The event which being rated
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event()
    {
        return $this->hasOne(\App\Models\Event::class);
    }

}
