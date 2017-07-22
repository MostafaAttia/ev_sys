<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\EventTransformer;
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

    /**
     * Show Home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $eventsOriginal = Event::where('is_live', 1)->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            return view('Front.Home.Home', compact('events', 'client'));
        }

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        Log::info($events['next_page_url']);
        Log::info($events);


        return view('Front.Home.Home', compact('events'));
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
