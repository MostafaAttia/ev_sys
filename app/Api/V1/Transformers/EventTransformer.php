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

        $events = [
            'id'                        => $event->id,
            'title'                     => $event->title,
            'desc'                      => $event->description,
            'start_date'                => $event->start_date,
            'end_date'                  => $event->end_date,
            'organiser'                 => array('id'=> $organiser->id ,'name'=>$organiser->name),
            'venue_name'                => $event->venue_name,
            'venue_name_full'           => $event->venue_name_full,
            'location_address'          => $event->location_address,
            'location_address_line_1'   => $event->location_address_line_1,
            'location_address_line_2'   => $event->location_address_line_2,
            'location_country'          => $event->location_country,
            'location_state'            => $event->location_state,
            'location_lat'              => $event->location_lat,
            'location_long'             => $event->location_long,
//            'is_live'                   => $event->is_live
        ];

        return $events;
    }
}