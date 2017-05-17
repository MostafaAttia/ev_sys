<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatRow extends MyBaseModel
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seat_row';
    public $timestamps = false;

    protected $fillable = [
        'auditorium_id',
        'row_name',
        'row_seats_no',
        'seat_price',
        'category',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules for the model.
     *
     * @var array $rules
     */
    protected $rules = [
        'row_name.*'          => ['required'],
        'row_seats_no.*'      => ['required', 'numeric'],
        'seat_price.*'        => ['required', 'numeric'],
        'category.*'          => ['required'],
    ];

    /**
     * The validation error messages for the model.
     *
     * @var array $messages
     */
    protected $messages = [
        'row_name.*.required'        => 'You must give a name for your row!',
        'row_seats_no.*.required'    => 'You must specify seats number',
        'seat_price.*.required'      => 'You must specify a price for a seat in this row',
        'category.*.required'        => 'You must specify a category for this row seats',
    ];

    /**
     * Get the seat classes.
     *
     * @return \Illuminate\Support\Collection|int|mixed|static
     */
    public function getSeatClassesAttribute()
    {
        return strtolower($this->row_name).'-seat';
    }

    /**
     * The spaces of this row
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spaces()
    {
        return $this->hasMany(\App\Models\RowSpace::class);
    }

    

    // /**
    //  * Seat Rows IDs Associated with auditorium
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function seatRowsIDS(){
    //     return $this->hasMany(\App\Models\SeatRow::class, 'seat_row')->select(['id']);
    // }


    // /**
    //  * Seat Rows names Associated with auditorium
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function seatRowsNames(){
    //     return $this->hasMany(\App\Models\SeatRow::class, 'seat_row')->select(['row_name']);
    // }

}