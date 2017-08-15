<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use League\Fractal;

use App\Models\Event;

class HomeController extends Controller
{

    use Helpers;


    public function testPayment()
    {
        return view('Front.Payment.Test');
    }





    /**
     * Show Home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $eventsOriginal = Event::where('is_live', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        $categories = Category::all();
        $categories = new Fractal\Resource\Collection($categories, new CategoryTransformer);
        $categories = $fractal->createData($categories)->toArray();

        $categories = $categories['data'];

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        if($request->ajax()){

            return view('Front.Home.Partials.MasonryGrid', compact('events'));

        }

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            return view('Front.Home.Home', compact('events', 'client', 'categories'));
        }

        return view('Front.Home.Home', compact('events', 'categories'));
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
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $eventsOriginal = Event::where(['category_id' => $category_id, 'is_live'=> 1])
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }

    /**
     * Get Events orderedBy orders' count
     */
    public function getPopularEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $eventsOriginal = Event::where('is_live', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->withCount('orders')
            ->orderBy('start_date', 'asc')
            ->orderBy('orders_count', 'desc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value) {
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }

    /**
     * Get Events orderedBy latest created
     */
    public function getLatestEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $carbon = Carbon::now()->toDateTimeString();
        $subWeek = Carbon::now()->subDays(7)->toDateTimeString();

        $eventsOriginal = Event::where('is_live', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->whereBetween('created_at', [$subWeek, $carbon] )
            ->orderBy('created_at', 'desc')
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value) {
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }


    /**
     * Get Events by location
     */
    public function getEventsByLocation($city, $country)
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $eventsOriginal = Event::where('is_live', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->where(function($query) use ($city, $country) {
                $query->where('location_address_line_2',  $city)
                    ->orWhere('venue_name_full', 'like', $city)
                    ->orWhere('location_country', $country);

            })
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value) {
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
