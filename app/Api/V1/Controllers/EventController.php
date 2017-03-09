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
     * Get all Events [including unpublished events]
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getAllEvents()
    {
        $events = Event::paginate(10);

        return $this->response->paginator($events, new EventTransformer);
    }


    /**
     * Get all live events
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getLiveEvents()
    {
        $events = Event::where('is_live', 1)->get();

        return $this->response->collection($events, new EventTransformer);
    }

    /**
     * Get Event by id
     *
     * <strong>Parameters:</strong>
     * <br>
     * event_id  : required|integer <br>
     *
     * @param $event_id
     * @return \Dingo\Api\Http\Response
     */
    public function getEvent($event_id)
    {
        $event = Event::findOrFail($event_id);

        return $this->response->item($event, new EventTransformer);

    }

    /**
     * List Attendees
     *
     * <strong>Parameters:</strong>
     * <br>
     * event_id  : required|integer <br>
     *
     * @param $event_id
     * @return \Dingo\Api\Http\Response
     */
    public function getEventAttendees($event_id)
    {
        $event = Event::findOrFail($event_id);

        $attendees = $event->attendees;

        return $this->response->collection($attendees, new AttendeeTransformer);
    }

    /**
     * List all Categories
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Get Events in a category
     *
     * <strong>Parameters:</strong>
     * <br>
     * category_id  : required|integer <br>
     *
     * @param $category_id
     * @return \Dingo\Api\Http\Response
     */
    public function getCategoryEvents($category_id)
    {
        $events = Event::where(['category_id' => $category_id, 'is_live'=> 1])->get();

        return $this->response->collection($events, new EventTransformer);
    }

    /**
     * Search Events by title, venue name, location
     * @param $query
     * @return \Dingo\Api\Http\Response
     */
    public function searchEvents($query)
    {
        $events = Event::search($query)->get();

        return $this->response->collection($events, new EventTransformer);
    }





}
