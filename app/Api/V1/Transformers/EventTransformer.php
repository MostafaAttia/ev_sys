<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Event;
use App\Models\Organiser;

class EventTransformer extends TransformerAbstract
{
    public function transform(Event $event)
    {

        $organiser  = Organiser::findOrFail($event->organiser_id);
        if($event->category_id){
            $category = $event->category;
        }

        // reformat date
        $end_date['date'] = $event->end_date->format('Y-m-d H:i:s');
        foreach($event->end_date->timezone as $key=>$value){
            $end_date[$key] = $value;
        }

        $start_date['date'] = $event->start_date->format('Y-m-d H:i:s');
        foreach($event->start_date->timezone as $key=>$value){
            $start_date[$key] = $value;
        }

        $events = [
            'id'                        => $event->id,
            'title'                     => $event->title,
            'desc'                      => $event->description,
            'image_path'                => $event->images->count() ? [
                'original'              => config('attendize.s3_base_url').config('attendize.s3_event_images_original').$event->images->first()['image_path'],
                '200*200'               => config('attendize.s3_base_url').config('attendize.s3_event_images_200_200').$event->images->first()['image_path'],
                '300*300'               => config('attendize.s3_base_url').config('attendize.s3_event_images_300_300').$event->images->first()['image_path'],
                '335*250'               => config('attendize.s3_base_url').config('attendize.s3_event_images_335_250').$event->images->first()['image_path'],
                '300*400'               => config('attendize.s3_base_url').config('attendize.s3_event_images_300_400').$event->images->first()['image_path'],
                '450*600'               => config('attendize.s3_base_url').config('attendize.s3_event_images_450_600').$event->images->first()['image_path'],
                '400*720'               => config('attendize.s3_base_url').config('attendize.s3_event_images_400_720').$event->images->first()['image_path'],
                '600*1080'              => config('attendize.s3_base_url').config('attendize.s3_event_images_600_1080').$event->images->first()['image_path']
            ] : [

                    'original'              => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). 'original.jpg',
                    '200*200'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '200*200.jpg',
                    '300*300'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '300*300.jpg',
                    '335*250'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). 'original.jpg',
                    '300*400'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '300*400.jpg',
                    '450*600'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '400*720.jpg',
                    '400*720'               => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '450*600.jpg',
                    '600*1080'              => config('attendize.s3_base_url').config('attendize.s3_event_defaults'). '600*1080.jpg'
                ,
            ],
            'start_date'                => $start_date,
            'end_date'                  => $end_date,
            'organiser'                 => [
                    'id'                => $organiser->id ,
                    'name'              => $organiser->name,
                    'image_path'              => $organiser->logo_path ? [
                        'original'              => config('attendize.s3_base_url').config('attendize.s3_organiser_original'). $organiser->logo_path,
                        '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_organiser_60_60'). $organiser->logo_path,
                        '120*120'               => config('attendize.s3_base_url').config('attendize.s3_organiser_120_120'). $organiser->logo_path,
                        '240*240'               => config('attendize.s3_base_url').config('attendize.s3_organiser_240_240'). $organiser->logo_path,
                    ] : [
                        'original'              => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). 'original.jpg',
                        '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '60*60.jpg',
                        '120*120'               => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '120*120.jpg',
                        '240*240'               => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '240*240.jpg',
                    ]
            ],
            'venue_name'                => $event->venue_name,
            'venue_name_full'           => $event->venue_name_full,
            'location_address'          => $event->location_address,
            'location_address_line_1'   => $event->location_address_line_1,
            'location_address_line_2'   => str_replace(' ', '', $event->location_address_line_2),
            'location_country'          => str_replace(' ', '', $event->location_country),
            'location_country_code'     => $event->location_country_code,
            'location_state'            => $event->location_state,
            'location_lat'              => $event->location_lat,
            'location_long'             => $event->location_long,
            'is_activity'               => $event->is_activity,
            'event_url'                 => $event->event_url,
            'social_show_facebook'      => $event->social_show_facebook,
            'category'                  => $event->category_id !== null ? [
                'id'                    => $category->id,
                'name'                  => $category->name
            ] : [
                'id'                    => null,
                'name'                  => null
            ]
        ];

        return $events;
    }
}