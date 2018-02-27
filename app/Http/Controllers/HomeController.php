<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Models\Category;
use App\Models\Organiser;
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

            if(Auth::guard('client')->user()) {
                $auth_client = Auth::guard('client')->user();
                $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
                $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
                $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();
                return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));
            }

            return view('Front.Home.Partials.MasonryGrid', compact('events'));

        }

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Home.Home', compact('events', 'client', 'categories', 'liked_events', 'favorites', 'following'));
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

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }


    /**
     * Get Events by organizers who are being followed by this client
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getFollowingsEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = Auth::guard('client')->user();
        $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

        $eventsOriginal = Event::whereIn('organiser_id', $following)
            ->where('is_live', '=', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->inRandomOrder()
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
        $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
        return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));

    }

    /**
     * Get Events from client's favorites categories
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getFavoritesCategoriesEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = Auth::guard('client')->user();
        $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();
        $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
        $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();

        $eventsOriginal = Event::whereIn('category_id', $favorites)
            ->where('is_live', '=', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }


        return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));

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

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));
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

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));
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

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Home.Partials.MasonryGrid', compact('events', 'liked_events', 'favorites', 'following'));
        }

        return view('Front.Home.Partials.MasonryGrid', compact('events'));
    }

}
