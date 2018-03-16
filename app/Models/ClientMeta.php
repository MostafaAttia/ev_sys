<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientMeta extends Model
{

    protected $table = 'client_meta';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'show_email',
        'show_gender',
        'show_phone',
        'show_address',
        'show_followings',
        'show_favorites',
        'show_likes',
        'show_attended_events',
        'get_notif_about_followings',
        'get_notif_about_favorites',
        'get_mail_notif'
    ];

    /**
     * The client associated with this meta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }
}
