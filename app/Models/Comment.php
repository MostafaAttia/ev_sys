<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'client_id',
        'content'
    ];

    /**
     * The validation rules
     *
     * @var array $rules
     */
    protected $rules = [
        'content' => ['required']
    ];

    /**
     * The event associated with the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }

    /**
     * The client associated with the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }


}
