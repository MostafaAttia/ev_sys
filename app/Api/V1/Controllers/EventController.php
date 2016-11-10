<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\EventTransformer;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Organiser;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
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





}
