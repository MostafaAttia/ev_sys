<?php

namespace App\Models;

use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Notifications\Notifiable;
use Str;

class Organiser extends MyBaseModel
{
    use SearchableTrait, CanBeFollowed, Notifiable;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'organisers.name' => 10
        ],
    ];

    /**
     * The validation rules for the model.
     *
     * @var array $rules
     */
    protected $rules = [
        'name'           => ['required'],
        'email'          => ['required', 'email'],
        'organiser_logo' => ['mimes:jpeg,jpg,png', 'max:10000'],
    ];

    /**
     * The validation error messages for the model.
     *
     * @var array $messages
     */
    protected $messages = [
        'name.required'        => 'You must at least give a name for the event organiser.',
        'organiser_logo.max'   => 'Please upload an image smaller than 10Mb',
        'organiser_logo.size'  => 'Please upload an image smaller than 10Mb',
        'organiser_logo.mimes' => 'Please select a valid image type (jpeg, jpg, png)',
    ];

    /**
     * The account associated with the organiser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    /**
     * The events associated with the organizer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }

    /**
     * The auditoriums associated with the organizer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditoriums()
    {
        return $this->hasMany(\App\Models\Auditorium::class);
    }


    /**
     * The attendees associated with the organizer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function attendees()
    {
        return $this->hasManyThrough(\App\Models\Attendee::class, \App\Models\Event::class);
    }

    /**
     * Get the orders related to an organiser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function orders()
    {
        return $this->hasManyThrough(\App\Models\Order::class, \App\Models\Event::class);
    }

    /**
     * Get the full logo path of the organizer.
     *
     * @return mixed|string
     */
    public function getFullLogoPathAttribute()
    {
        if ($this->logo_path) {
            return config('attendize.s3_base_url') . config('attendize.s3_organiser_original') . $this->logo_path;
        }

        return config('attendize.s3_base_url') . config('attendize.s3_organiser_defaults'). 'original.jpg';

    }

    /**
     * Get the url of the organizer.
     *
     * @return string
     */
    public function getOrganiserUrlAttribute()
    {
        return route('showOrganiserHome', [
            'organiser_id'   => $this->id,
            'organiser_slug' => Str::slug($this->oraganiser_name),
        ]);
    }

    /**
     * Get the sales volume of the organizer.
     *
     * @return mixed|number
     */
    public function getOrganiserSalesVolumeAttribute()
    {
        return $this->events->sum('sales_volume');
    }

    /**
     * return path of organisers' avatar, optionally select avatar size, default size is '60*60'
     * available sizes: 60 / 120 / 240 / original
     *
     * @param string $size
     * @return string
     */
    public function getAvatar($size = '60')
    {
        if($this->logo_path) {
            switch ($size) {
                case 'original':
                    return config('attendize.s3_base_url').config('attendize.s3_organiser_original'). $this->logo_path;
                    break;
                case '60':
                    return config('attendize.s3_base_url').config('attendize.s3_organiser_60_60'). $this->logo_path;
                    break;
                case '120':
                    return config('attendize.s3_base_url').config('attendize.s3_organiser_120_120'). $this->logo_path;
                    break;
                case '240':
                    return config('attendize.s3_base_url').config('attendize.s3_organiser_240_240'). $this->logo_path;
                    break;
                default:
                    return config('attendize.s3_base_url').config('attendize.s3_organiser_60_60'). $this->logo_path;
            }
        }

        return config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). 'original.jpg';
    }

    /**
     * TODO:implement DailyStats method
     */
    public function getDailyStats()
    {
    }
}
