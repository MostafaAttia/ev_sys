<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatReserved extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seat_reserved';

    protected $fillable = [
        'seat_id',
        'screening_id',
        'attendee_id',
        'created_at',
        'updated_at'
    ];
}