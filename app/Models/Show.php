<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Show extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'auditorium_id',
        'row_name',
        'row_seats_no',
        'seat_price',
        'seat_data',
        'created_at',
        'updated_at',
    ];

    /**
     * The screening associated with the show
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenings()
    {
        return $this->hasMany(\App\Models\Screening::class, 'screening');
    }
}