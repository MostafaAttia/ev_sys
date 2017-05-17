<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RowSpace extends MyBaseModel
{
    use SoftDeletes;

    protected $table = 'row_spaces';
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'row_id',
        'starts_at',
        'ends_at',
        'deleted_at'
    ];

    /**
     * The validation rules for the model.
     *
     * @var array $rules
     */
    protected $rules = [
        'starts_at.*'    => ['required', 'numeric'],
        'ends_at.*'      => ['required', 'numeric']
    ];

    /**
     * The validation error messages for the model.
     *
     * @var array $messages
     */
    protected $messages = [
        'starts_at.*.required'  => 'You must give a starting point for the new space!',
        'ends_at.*.required'    => 'You must give an ending point for the new space!'
    ];


    /**
     * The auditorium associated with the screening
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function row()
    {
        return $this->belongsTo(\App\Models\SeatRow::class);
    }

    

}