<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\AttendeeTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use App\Models\Category;
use App\Models\Event;
use League\Fractal;
use Validator;
use Image;
use Auth;
use Log;


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

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $events = new Fractal\Resource\Collection($events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);
    }


    /**
     * Get all live events
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getLiveEvents()
    {
        $events = Event::where('is_live', 1)->get();

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $events = new Fractal\Resource\Collection($events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);

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

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $event = new Fractal\Resource\Item($event, new EventTransformer);
        $event = $fractal->createData($event)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $event,
                'message'   => null,
            ], 200);

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

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $attendees = new Fractal\Resource\Collection($attendees, new EventTransformer);
        $attendees = $fractal->createData($attendees)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $attendees['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * List all Categories
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $categories,
                'message'   => null,
            ], 200);
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

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $events = new Fractal\Resource\Collection($events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * Get Events by organiser id
     *
     * <strong>Parameters:</strong>
     * <br>
     * organiser_id  : required|integer <br>
     *
     * @param $organiser_id
     * @return \Dingo\Api\Http\Response
     */
    public function getOrganiserEvents($organiser_id)
    {
        $events = Event::where(['organiser_id' => $organiser_id, 'is_live'=> 1])->get();

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $events = new Fractal\Resource\Collection($events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * Search Events by title, venue name, location
     * @param $query
     * @return \Dingo\Api\Http\Response
     */
    public function searchEvents($query)
    {
        $events = Event::search($query)->get();

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $events = new Fractal\Resource\Collection($events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);

    }

}
