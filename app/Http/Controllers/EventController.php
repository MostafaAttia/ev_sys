<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Organiser;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use Log;
use Validator;

class EventController extends MyBaseController
{
    /**
     * Show the 'Create Event' Modal
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showCreateEvent(Request $request)
    {
        $categories = Category::lists('name', 'id')->all();


        $data = [
            'modal_id'     => $request->get('modal_id'),
            'organisers'   => Organiser::scope()->lists('name', 'id'),
            'organiser_id' => $request->get('organiser_id') ? $request->get('organiser_id') : false,
            'categories'   => $categories,
        ];

        return view('ManageOrganiser.Modals.CreateEvent', $data);
    }

    
    /**
     * Create an event
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateEvent(Request $request)
    {
        $event = Event::createNew();

        $is_activity = $request->has('is_activity');

        if (!$event->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $event->errors(),
            ]);
        }

        $event->title = $request->get('title');
        $event->description = strip_tags($request->get('description'));
        $event->category_id = $request->get('category_id');

        if($is_activity){
            $event->is_activity = 1;
            $event->start_date = $request->get('activity_start_date') ? Carbon::createFromFormat('d-m-Y H:i',$request->get('activity_start_date'). ' 00:00') : null;
            $event->end_date = $request->get('activity_end_date') ? Carbon::createFromFormat('d-m-Y H:i',$request->get('activity_end_date'). ' 23:59') : null;
            $event->activity_start_time = $request->get('activity_start_time') ? Carbon::createFromFormat('H:i',$request->get('activity_start_time')) : null;

            $event->activity_end_time = $request->get('activity_end_time') ? Carbon::createFromFormat('H:i',
            $request->get('activity_end_time')) : null;

        } else {
            $event->start_date = $request->get('start_date') ? Carbon::createFromFormat('d-m-Y H:i',$request->get('start_date')) : null;

            $event->end_date = $request->get('end_date') ? Carbon::createFromFormat('d-m-Y H:i',$request->get('end_date')) : null;
        }


        /*
         * Venue location info (Usually auto-filled from google maps)
         */

        $is_auto_address = (trim($request->get('place_id')) !== '');

        if ($is_auto_address) { /* Google auto filled */
            $event->venue_name = $request->get('name');
            $event->venue_name_full = $request->get('venue_name_full');
            $event->location_lat = $request->get('lat');
            $event->location_long = $request->get('lng');
            $event->location_address = $request->get('formatted_address');
            $event->location_country = $request->get('country');
            $event->location_country_code = $request->get('country_short');
            $event->location_state = $request->get('administrative_area_level_1');
            $event->location_address_line_1 = $request->get('route');
            $event->location_address_line_2 = $request->get('locality');
            $event->location_post_code = $request->get('postal_code');
            $event->location_street_number = $request->get('street_number');
            $event->location_google_place_id = $request->get('place_id');
            $event->location_is_manual = 0;
        } else { /* Manually entered */
            $event->venue_name = $request->get('location_venue_name');
            $event->location_address_line_1 = $request->get('location_address_line_1');
            $event->location_address_line_2 = $request->get('location_address_line_2');
            $event->location_state = $request->get('location_state');
            $event->location_post_code = $request->get('location_post_code');
            $event->location_is_manual = 1;
        }

        $event->currency_id = Auth::user()->account->currency_id;
        //$event->timezone_id = Auth::user()->account->timezone_id;
        /*
         * Set a default background for the event
         */
        $event->bg_type = 'image';
        $event->bg_image_path = config('attendize.event_default_bg_image');


        if ($request->get('organiser_name')) {
            $organiser = Organiser::createNew(false, false, true);

            $rules = [
                'organiser_name'  => ['required'],
                'organiser_email' => ['required', 'email'],
            ];
            $messages = [
                'organiser_name.required' => 'You must give a name for the event organiser.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => 'error',
                    'messages' => $validator->messages()->toArray(),
                ]);
            }

            $organiser->name = $request->get('organiser_name');
            $organiser->about = $request->get('organiser_about');
            $organiser->email = $request->get('organiser_email');
            $organiser->facebook = $request->get('organiser_facebook');
            $organiser->twitter = $request->get('organiser_twitter');
            $organiser->save();
            $event->organiser_id = $organiser->id;

        } elseif ($request->get('organiser_id')) {
            $event->organiser_id = $request->get('organiser_id');
        } else { /* Somethings gone horribly wrong */
            return response()->json([
                'status'   => 'error',
                'messages' => 'There was an issue finding the organiser.',
            ]);
        }

        /*
         * Set the event defaults.
         * @todo these could do mass assigned
         */
        $defaults = $event->organiser->event_defaults;
        if ($defaults) {
            $event->organiser_fee_fixed = $defaults->organiser_fee_fixed;
            $event->organiser_fee_percentage = $defaults->organiser_fee_percentage;
            $event->pre_order_display_message = $defaults->pre_order_display_message;
            $event->post_order_display_message = $defaults->post_order_display_message;
            $event->offline_payment_instructions = $defaults->offline_payment_instructions;
            $event->enable_offline_payments = $defaults->enable_offline_payments;
            $event->social_show_facebook = $defaults->social_show_facebook;
            $event->social_show_linkedin = $defaults->social_show_linkedin;
            $event->social_show_twitter = $defaults->social_show_twitter;
            $event->social_show_email = $defaults->social_show_email;
            $event->social_show_googleplus = $defaults->social_show_googleplus;
            $event->social_show_whatsapp = $defaults->social_show_whatsapp;
            $event->is_1d_barcode_enabled = $defaults->is_1d_barcode_enabled;
            $event->ticket_border_color = $defaults->ticket_border_color;
            $event->ticket_bg_color = $defaults->ticket_bg_color;
            $event->ticket_text_color = $defaults->ticket_text_color;
            $event->ticket_sub_text_color = $defaults->ticket_sub_text_color;
        }


        try {
            $event->save();
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'status'   => 'error',
                'messages' => 'Whoops! There was a problem creating your event. Please try again.',
            ]);
        }

        if($is_activity){
            $weekdays = $request->get('weekdays');
            $event->weekdays()->attach($weekdays);
        }

        if ($request->hasFile('event_image')) {

            $image = $request->file('event_image');
            $imageName = 'event_image_'.md5(time() . $event->id).'.'.$image->getClientOriginalExtension();
            Storage::disk('s3')->put('event_images/original/'.$imageName, file_get_contents($image), 'public');

            $eventImage = EventImage::createNew();
            $eventImage->image_path = $imageName;
            $eventImage->event_id = $event->id;
            $eventImage->save();

            // save as THUMB 200*?
            $image_thumb_200_200 = Image::make($image)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/200*200/'.$imageName, $image_thumb_200_200->__toString(), 'public');

            // save as THUMB 300*?
            $image_thumb_300_300 = Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/300*300/'.$imageName, $image_thumb_300_300->__toString(), 'public');

            // save as VERTICAL poster 400*?
            $image_vert_poster_300_400 = Image::make($image)->resize(300, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/300*400/'.$imageName, $image_vert_poster_300_400->__toString(), 'public');

            // save as VERTICAL poster 600*?
            $image_vert_poster_450_600 = Image::make($image)->resize(450, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/450*600/'.$imageName, $image_vert_poster_450_600->__toString(), 'public');

            // save as VERTICAL poster 720*?
            $image_horiz_poster_400_720 = Image::make($image)->resize(null, 720, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/400*720/'.$imageName, $image_horiz_poster_400_720->__toString(), 'public');

            // save as VERTICAL poster 1080*?
            $image_horiz_poster_600_1080 = Image::make($image)->resize(null, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/600*1080/'.$imageName, $image_horiz_poster_600_1080->__toString(), 'public');

        }

        return response()->json([
            'status'      => 'success',
            'id'          => $event->id,
            'redirectUrl' => route('showEventTickets', [
                'event_id'  => $event->id,
                'first_run' => 'yup',
            ]),
        ]);
    }

    /**
     * Edit an event
     *
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditEvent(Request $request, $event_id)
    {
        $event = Event::scope()->findOrFail($event_id);

        if (!$event->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $event->errors(),
            ]);
        }

        $is_activity = $request->has('is_activity') ? true : false;

        $event->is_live = $request->get('is_live');
        $event->title = $request->get('title');
        $event->description = strip_tags($request->get('description'));
        $event->category_id = $request->get('category_id');
        $event->start_date = $request->get('start_date') ? Carbon::createFromFormat('d-m-Y H:i',
            $request->get('start_date') . ($event->is_activity ?  ' 00:00' : '') ) : null;

        if($is_activity){

            $event->activity_start_time = $request->get('activity_start_time') ? Carbon::createFromFormat('H:i',
                $request->get('activity_start_time')) : null;

            $event->activity_end_time = $request->get('activity_end_time') ? Carbon::createFromFormat('H:i',
                $request->get('activity_end_time')) : null;

            $weekdays = Input::get('weekdays');
            $event->weekdays()->sync($weekdays);

        }


        /*
         * If the google place ID is the same as before then don't update the venue
         */
        if (($request->get('place_id') !== $event->location_google_place_id) || $event->location_google_place_id == '') {
            $is_auto_address = (trim($request->get('place_id')) !== '');

            if ($is_auto_address) { /* Google auto filled */
                $event->venue_name = $request->get('name');
                $event->venue_name_full = $request->get('venue_name_full');
                $event->location_lat = $request->get('lat');
                $event->location_long = $request->get('lng');
                $event->location_address = $request->get('formatted_address');
                $event->location_country = $request->get('country');
                $event->location_country_code = $request->get('country_short');
                $event->location_state = $request->get('administrative_area_level_1');
                $event->location_address_line_1 = $request->get('route');
                $event->location_address_line_2 = $request->get('locality');
                $event->location_post_code = $request->get('postal_code');
                $event->location_street_number = $request->get('street_number');
                $event->location_google_place_id = $request->get('place_id');
                $event->location_is_manual = 0;
            } else { /* Manually entered */
                $event->venue_name = $request->get('location_venue_name');
                $event->location_address_line_1 = $request->get('location_address_line_1');
                $event->location_address_line_2 = $request->get('location_address_line_2');
                $event->location_state = $request->get('location_state');
                $event->location_post_code = $request->get('location_post_code');
                $event->location_is_manual = 1;
                $event->location_google_place_id = '';
                $event->venue_name_full = '';
                $event->location_lat = '';
                $event->location_long = '';
                $event->location_address = '';
                $event->location_country = '';
                $event->location_country_code = '';
                $event->location_street_number = '';
            }
        }

        $event->end_date = $request->get('end_date') ? Carbon::createFromFormat('d-m-Y H:i',
            $request->get('end_date') . ($event->is_activity ?  ' 23:59' : '')) : null;

        if ($request->get('remove_current_image') == '1') {
            EventImage::where('event_id', '=', $event->id)->delete();
        }

        $event->save();

        if ($request->hasFile('event_image')) {

            $image = $request->file('event_image');
            $imageName = 'event_image_'.md5(time() . $event->id).'.'.$image->getClientOriginalExtension();
            Storage::disk('s3')->put('event_images/original/'.$imageName, file_get_contents($image), 'public');

            $eventImage = EventImage::createNew();
            $eventImage->image_path = $imageName;
            $eventImage->event_id = $event->id;
            $eventImage->save();

            // save as THUMB 200*?
            $image_thumb_200_200 = Image::make($image)->resize(200, 200)->stream();
            Storage::disk('s3')->put('event_images/200*200/'.$imageName, $image_thumb_200_200->__toString(), 'public');

            // save as THUMB 300*?
            $image_thumb_300_300 = Image::make($image)->resize(300, 300)->stream();
            Storage::disk('s3')->put('event_images/300*300/'.$imageName, $image_thumb_300_300->__toString(), 'public');

            // save as THUMB 300*?
            $image_thumb_335_250 = Image::make($image)->resize(335, 250)->stream();
            Storage::disk('s3')->put('event_images/335*250/'.$imageName, $image_thumb_335_250->__toString(), 'public');

            // save as VERTICAL poster 400*?
            $image_vert_poster_300_400 = Image::make($image)->resize(300, 400)->stream();
            Storage::disk('s3')->put('event_images/300*400/'.$imageName, $image_vert_poster_300_400->__toString(), 'public');

            // save as VERTICAL poster 600*?
            $image_vert_poster_450_600 = Image::make($image)->resize(450, 600)->stream();
            Storage::disk('s3')->put('event_images/450*600/'.$imageName, $image_vert_poster_450_600->__toString(), 'public');

            // save as VERTICAL poster 720*?
            $image_horiz_poster_400_720 = Image::make($image)->resize(null, 720, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/400*720/'.$imageName, $image_horiz_poster_400_720->__toString(), 'public');

            // save as VERTICAL poster 1080*?
            $image_horiz_poster_600_1080 = Image::make($image)->resize(null, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('event_images/600*1080/'.$imageName, $image_horiz_poster_600_1080->__toString(), 'public');

        }

        return response()->json([
            'status'      => 'success',
            'id'          => $event->id,
            'message'     => 'Event Successfully Updated',
            'redirectUrl' => '',
        ]);
    }

    /**
     * Upload event image
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUploadEventImage(Request $request)
    {
        if ($request->hasFile('event_image')) {
            $the_file = \File::get($request->file('event_image')->getRealPath());
            $file_name = 'event_details_image-' . md5(microtime()) . '.' . strtolower($request->file('event_image')->getClientOriginalExtension());

            $relative_path_to_file = config('attendize.event_images_path') . '/' . $file_name;
            $full_path_to_file = public_path() . '/' . $relative_path_to_file;

            $img = Image::make($the_file);

            $img->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save($full_path_to_file);
            if (\Storage::put($file_name, $the_file)) {
                return response()->json([
                    'link' => '/' . $relative_path_to_file,
                ]);
            }

            return response()->json([
                'error' => 'There was a problem uploading your image.',
            ]);
        }
    }
}
