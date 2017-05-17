<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends MyBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'seat_row_id',
        'seat_label'
    ];

    /**
     * The reserved_seats associated with the seat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seatReserved()
    {
        return $this->hasMany(\App\Models\SeatReserved::class, 'seat_reserved');
    }
}