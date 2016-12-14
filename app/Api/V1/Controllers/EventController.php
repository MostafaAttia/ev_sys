<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\AttendeeTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Auth;
use Image;
use Log;
use Validator;

use Dingo\Api\Routing\Helpers;

class EventController extends Controller
{

    use Helpers;


    /**
     * Return all events, including unpublished events
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getAllEvents()
    {
        $events = Event::paginate(10);

        return $this->response->paginator($events, new EventTransformer);
    }


    /**
     * Return all live events
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getLiveEvents()
    {
        $events = Event::where('is_live', 1)->get();

        return $this->response->collection($events, new EventTransformer);
    }

    public function getEvent($event_id)
    {
        $event = Event::findOrFail($event_id);

        return $this->response->item($event, new EventTransformer);

    }

    public function getEventAttendees($event_id)
    {
        $event = Event::findOrFail($event_id);

        $attendees = $event->attendees;

        return $this->response->collection($attendees, new AttendeeTransformer);
    }

    public function getCategories()
    {
        $categories = Category::all();

        return $categories;
    }

    public function getCategoryEvents($category_id)
    {
        $events = Event::where(['category_id' => $category_id, 'is_live'=> 1])->get();

        return $this->response->collection($events, new EventTransformer);
    }

    public function searchEvents($query)
    {
        $events = Event::search($query)->get();

        return $this->response->collection($events, new EventTransformer);
    }





}
