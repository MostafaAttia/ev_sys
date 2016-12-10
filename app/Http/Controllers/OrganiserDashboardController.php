<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use Carbon\Carbon;
use Log;

class OrganiserDashboardController extends MyBaseController
{
    /**
     * Show the organiser dashboard
     *
     * @param $organiser_id
     * @return mixed
     */
    public function showDashboard($organiser_id)
    {
        $organiser = Organiser::scope()->findOrFail($organiser_id);
        $upcoming_events = $organiser->events()->where('end_date', '>=', Carbon::now())->get();
        $calendar_events = [];
        $calendar_activities = [];

        /* Prepare JSON array for events for use in the dashboard calendar */
        foreach ($organiser->events as $event) {
            if($event->is_activity){

                $weekdays = $event->weekdays;
                $weekdays_ids = [];
                foreach($weekdays as $weekday)
                {
                    array_push($weekdays_ids, $weekday['id']);
                }

                $calendar_activities[] = [
                    'id'    => $event->id,
                    'title' => $event->title,
                    'start' => $event->activity_start_time,
                    'end'   => $event->activity_end_time,
                    'dow'   => $weekdays_ids,
                    'ranges'=> ["start"=> $event->start_date->toIso8601String(), "end"=> $event->end_date->toIso8601String()],
                    'url'   => route('showEventDashboard', [
                        'event_id' => $event->id
                    ]),
                    'color' => '#0F8000'
                ];


            } else {

                $calendar_events[] = [
                    'id'    => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date->toIso8601String(),
                    'end'   => $event->end_date->toIso8601String(),
                    'url'   => route('showEventDashboard', [
                        'event_id' => $event->id
                    ]),
                    'color' => '#4E558F'
                ];

            }

        }

        $data = [
            'organiser'             => $organiser,
            'upcoming_events'       => $upcoming_events,
            'calendar_events'       => json_encode($calendar_events),
            'calendar_activities'   => json_encode($calendar_activities),
        ];

        return view('ManageOrganiser.Dashboard', $data);
    }
}
