<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screening extends MyBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'screening_start',
        'auditorium_id',
        'event_id'
    ];


    /**
     * The auditorium associated with the screening
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditoriums()
    {
        return $this->belongsTo(\App\Models\Auditorium::class);
    }

    /**
     * The reserved_seats associated with the screening
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seatReserved()
    {
        return $this->hasMany(\App\Models\SeatReserved::class);
    }

}