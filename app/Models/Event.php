<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Str;
use URL;

use Nicolaslopezj\Searchable\SearchableTrait;

class Event extends MyBaseModel
{
    use SoftDeletes, SearchableTrait, CanBeLiked;

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'events.title' => 10,
            'events.venue_name' => 8,
            'events.location_address_line_2' => 2,
        ],
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $casts = [
        'is_activity'       => 'boolean',
    ];

    /**
     * The validation rules.
     *
     * @var array $rules
     */
    protected $rules = [
        'title'               => ['required'],
        'description'         => ['required'],
        'location_venue_name' => ['required_without:venue_name_full'],
        'venue_name_full'     => ['required_without:location_venue_name'],
        'start_date'          => ['required_without_all:activity_start_date,activity_end_date,activity_start_time,activity_end_time'],
        'end_date'            => ['required_without_all:activity_start_date,activity_end_date,activity_start_time,activity_end_time'],
        'organiser_name'      => ['required_without:organiser_id'],
        'event_image'         => ['mimes:jpeg,jpg,png', 'max:3000'],
        'category_id'         => ['required'],

        'activity_start_date' => ['required_without_all:start_date, end_date'],
        'activity_end_date'   => ['required_without_all:start_date, end_date'],
        'activity_start_time' => ['required_without_all:start_date, end_date'],
        'activity_end_time'   => ['required_without_all:start_date, end_date'],
    ];

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    protected $messages = [
        'title.required'                       => 'You must at least give a title for your event.',
        'organiser_name.required_without'      => 'Please create an organiser or select an existing organiser.',
        'event_image.mimes'                    => 'Please ensure you are uploading an image (JPG, PNG, JPEG)',
        'event_image.max'                      => 'Pleae ensure the image is not larger then 3MB',
        'location_venue_name.required_without' => 'Please enter a venue for your event',
        'venue_name_full.required_without'     => 'Please enter a venue for your event',
        'category_id.required'                 => 'Please select a category for your event',

        'start_date.required_without_all'          => 'Please select a starting date for your event',
        'end_date.required_without_all'            => 'Please select an ending date for your event',

        'activity_start_date.required_without_all' => 'Please select a starting date for your activity',
        'activity_end_date.required_without_all'   => 'Please select an ending date for your activity',
        'activity_start_time.required_without_all' => 'Please select a starting time for your activity',
        'activity_end_time.required_without_all'   => 'Please select an ending time for your activity',


    ];


    /**
     * The Screening associated with the Show (Movie, Play)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenings()
    {
        return $this->belongsToMany(\App\Models\Screening::class, 'screening');
    }

    /**
     * The weekdays associated with the event/activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function weekdays()
    {
        return $this->belongsToMany(\App\Models\Weekday::class, 'activity_weekdays')->select(['id']);
    }

    public function weekdays_names()
    {
        return $this->belongsToMany(\App\Models\Weekday::class, 'activity_weekdays')->select(['name']);
    }

    public function weekdays_array()
    {
        $weekdays = $this->weekdays;
        $weekdays_ids = [];
        foreach($weekdays as $weekday)
        {
            array_push($weekdays_ids, $weekday['id']);
        }

        return $weekdays_ids;
    }

    /**
     * The comments associated with the event
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    /**
     * The ratings associated with the event
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }

    /**
     * The category associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }


    /**
     * The questions associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(\App\Models\Question::class, 'event_question');
    }

    /**
     * The questions associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions_with_trashed()
    {
        return $this->belongsToMany(\App\Models\Question::class, 'event_question')->withTrashed();
    }

    /**
     * The attendees associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendees()
    {
        return $this->hasMany(\App\Models\Attendee::class);
    }

    /**
     * The images associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(\App\Models\EventImage::class);
    }

    /**
     * The messages associated with the event.
     *
     * @return mixed
     */
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class)->orderBy('created_at', 'DESC');
    }

    /**
     * The tickets associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class);
    }

    /**
     * The stats associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function stats()
    {
        return $this->hasMany(\App\Models\EventStats::class);
    }


    /**
     * The affiliates associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function affiliates()
    {
        return $this->hasMany(\App\Models\Affiliate::class);
    }

    /**
     * The orders associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * The account associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    /**
     * The currency associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    /**
     * The organizer associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organiser()
    {
        return $this->belongsTo(\App\Models\Organiser::class);
    }


    /**
     * Get the embed url.
     *
     * @return mixed
     */
    public function getEmbedUrlAttribute()
    {
        return str_replace(['http:', 'https:'], '', route('showEmbeddedEventPage', ['event' => $this->id]));
    }

    /**
     * Get the fixed fee.
     *
     * @return mixed
     */
    public function getFixedFeeAttribute()
    {
        return config('attendize.ticket_booking_fee_fixed') + $this->organiser_fee_fixed;
    }

    /**
     * Get the percentage fee.
     *
     * @return mixed
     */
    public function getPercentageFeeAttribute()
    {
        return config('attendize.ticket_booking_fee_percentage') + $this->organiser_fee_percentage;
    }

    /**
     * Indicates whether the event is currently happening.
     *
     * @return bool
     */
    public function getHappeningNowAttribute()
    {
        return Carbon::now()->between($this->start_date, $this->end_date);
    }

    /**
     * Get the currency symbol.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrencySymbolAttribute()
    {
        return $this->currency->symbol_left;
    }

    /**
     * Get the currency code.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrencyCodeAttribute()
    {
        return $this->currency->code;
    }

    /**
     * Return an array of attendees and answers they gave to questions at checkout
     *
     * @return array
     */
    public function getSurveyAnswersAttribute()
    {
        $rows[] = array_merge([
            'Order Ref',
            'Attendee Name',
            'Attendee Email',
            'Attendee Ticket'
        ], $this->questions->pluck('title')->toArray());

        $attendees = $this->attendees()->has('answers')->get();

        foreach ($attendees as $attendee) {

            $answers = [];

            foreach ($this->questions as $question) {

                if (in_array($question->id, $attendee->answers->pluck('question_id')->toArray())) {
                    $answers[] = $attendee->answers->where('question_id', $question->id)->first()->answer_text;
                } else {
                    $answers[] = null;
                }

            }

            $rows[] = array_merge([
                $attendee->order->order_reference,
                $attendee->full_name,
                $attendee->email,
                $attendee->ticket->title
            ], $answers);

        }

        return $rows;
    }

    /**
     * Get the embed html code.
     *
     * @return string
     */
    public function getEmbedHtmlCodeAttribute()
    {
        return "<!--Vitee.com Ticketing Embed Code-->
                <iframe style='overflow:hidden; min-height: 350px;' frameBorder='0' seamless='seamless' width='100%' height='100%' src='" . $this->embed_url . "' vspace='0' hspace='0' scrolling='auto' allowtransparency='true'></iframe>
                <!--/Vitee.com Ticketing Embed Code-->";
    }

    /**
     * Get a usable address for embedding Google Maps
     *
     */
    public function getMapAddressAttribute()
    {
        $string = $this->venue . ','
            . $this->location_street_number . ','
            . $this->location_address_line_1 . ','
            . $this->location_address_line_2 . ','
            . $this->location_state . ','
            . $this->location_post_code . ','
            . $this->location_country;

        return urlencode($string);
    }

    /**
     * Get the big image url.
     *
     * @return string
     */
    public function getBgImageUrlAttribute()
    {
        return URL::to('/') . '/' . $this->bg_image_path;
    }

    /**
     * Get the url of the event.
     *
     * @return string
     */
    public function getEventUrlAttribute()
    {
        return URL::to('/') . '/e/' . $this->id . '/' . Str::slug($this->title);
    }

    /**
     * Get the sales and fees volume.
     *
     * @return \Illuminate\Support\Collection|mixed|static
     */
    public function getSalesAndFeesVoulmeAttribute()
    {
        return $this->sales_volume + $this->organiser_fees_volume;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @return array $dates
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'start_date', 'end_date'];
    }

    public function getIcsForEvent()
    {
        $siteUrl = URL::to('/');
        $eventUrl = $this->getEventUrlAttribute();

        $start_date = new Carbon($this->start_date);
        $end_date = new Carbon($this->end_date);
        $timestamp = new Carbon();

        $icsTemplate = <<<ICSTemplate
BEGIN:VCALENDAR
VERSION:2.0
PRODID:{$siteUrl}
BEGIN:VEVENT
UID:{$eventUrl}
DTSTAMP:{$timestamp->format('Ymd\THis\Z')}
DTSTART:{$start_date->format('Ymd\THis\Z')}
DTEND:{$end_date->format('Ymd\THis\Z')}
SUMMARY:$this->title
LOCATION:{$this->venue_name}
DESCRIPTION:{$this->description}
END:VEVENT
END:VCALENDAR
ICSTemplate;

        return $icsTemplate;
    }

    /**
     * Indicates whether the user can comment on this event or not (event ended or activity begin?)
     *
     * @return bool
     */
    public function getCanCommentAttribute()
    {
        if($this->is_activity){
            $start_date = new Carbon($this->start_date);
            return $start_date->isPast();
        } else {
            $end_date = new Carbon($this->end_date);
            return $end_date->isPast();
        }
    }

}
