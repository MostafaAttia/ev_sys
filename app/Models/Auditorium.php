<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Log;

class Auditorium extends MyBaseModel
{
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'auditorium';

    protected $fillable = [
        'name',
        'seats_no',
        'columns_no',
        'rows_no',
        'organiser_id',
        'account_id',
        'is_public'
    ];

    /**
     * The validation rules for the model.
     *
     * @var array $rules
     */
    protected $rules = [
        'name'          => ['required'],
        'seats_no'      => ['required', 'numeric'],
        'columns_no'    => ['required', 'numeric'],
        'rows_no'       => ['required', 'numeric'],
    ];

    /**
     * The validation error messages for the model.
     *
     * @var array $messages
     */
    protected $messages = [
        'name.required'        => 'You must give a name for your auditorium!',
        'seats_no.required'    => 'You must specify seats number',
        'columns_no.required'  => 'You must specify columns number',
        'rows_no.required'     => 'You must specify rows number',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The account associated with the Auditorium.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    /**
     * The organisers associated with the auditorium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisers()
    {
        return $this->belongsTo(\App\Models\Organiser::class);
    }

    /**
     * The Screening associated with the auditorium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenings()
    {
        return $this->hasMany(\App\Models\Screening::class);
    }

    /**
     * Seats Associated with auditorium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seats()
    {
        return $this->hasMany(\App\Models\Seat::class);
    }

    /**
     * Seat Rows Associated with auditorium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seatRows()
    {
        return $this->hasMany(\App\Models\SeatRow::class);
    }

    /**
     * Get the seat map as a multidiminsional array of rows and seats.
     *
     * @return array
     */
    public function getSeatsMapArrayAttribute()
    {
        $seats = [];
        $rowsArray = [];

        foreach ($this->seatRows as $key => $row) { // inside single row
            $seatsArray = [];
            $rowSpaces = RowSpace::where('row_id', '=', $row->id)->get();
            for($i = 1; $i <= $row->row_seats_no; $i++){ // print seat or space
                foreach ($rowSpaces as $spaceKey => $rowSpace) { // inside space object
                    if($i > $rowSpace->starts_at && $i < $rowSpace->ends_at)
                    {
                        for($spaceCounter = $i; $spaceCounter < $rowSpace->ends_at; $spaceCounter++){ // while in this space
                            $seatsArray["s$spaceCounter"] = "_";
                        }
                    }
                }

                $seatsArray[$i] = "$row->row_name$i";
            }

            $seats['seats'] = $seatsArray;
            $seats['meta'] = array(
                'price'     => $row->seat_price,
                'classes'   => $row->seatClasses,
                'category'  => $row->category ? $row->category : 'seat',

            );

            $rowsArray[$row->row_name] = $seats;

        }

        return $rowsArray;
    }

    /**
     * Get the seat map fields to pass to javascript view.
     *
     * @return string
     */
    public function getMapFieldsAttribute()
    {

        $auditorium = $this;
        $seats = "{";
        $map = "[";
        $rows = [];

        foreach ($this->seatsMapArray as $rowName => $row) {
            $map = $map."'";
            foreach ($row['seats'] as $seatKey => $seat) { // fill the seat map
                if(is_string($seatKey)){
                    $map = $map.$seat;
                } else {
                    $map = $map.$rowName."[$seat]";
                }
            }
            $map = $map."',";
            $seats = $seats."{$rowName}:{'price': {$row['meta']['price']}, 'classes': '{$row['meta']['classes']}', 'category': '{$row['meta']['category']}'},";
            array_push($rows, $rowName);
        }

        $map = $map."]";
        $rows = json_encode($rows);
        $seats = $seats."}";

        return compact('auditorium', 'seats', 'map', 'rows');

    }


}