<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organiser;
use Illuminate\Http\Request;
use League\Fractal;
use Auth;

class CategoriesController extends Controller
{

    /**
     * show all categories
     */
    public function index()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());
        $categories = Category::all();

        $categories_array = [];
        foreach($categories as $category){
            $category = new Fractal\Resource\Item($category, new CategoryTransformer);
            $category = $fractal->createData($category)->toArray();
            array_push($categories_array, $category);
        }
        $categories = $categories_array;

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();

            return view('Front.Categories.Categories', compact('categories', 'favorites', 'client'));
        }

        return view('Front.Categories.Categories', compact('categories'));
    }

    /**
     * show a specific category
     */
    public function showCategory($category_id)
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

        $category = Category::where('id',$category_id)->get();
        $category = new Fractal\Resource\Collection($category, new CategoryTransformer);
        $category = $fractal->createData($category)->toArray();

        $category = $category['data'][0];

        if(Auth::guard('client')->user()) {
            $auth_client = Auth::guard('client')->user();
            $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
            $client = $fractal->createData($client_obj)->toArray();
            $liked_events = $auth_client->likes(Event::class)->get()->pluck('id')->toArray();
            $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();
            $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

            return view('Front.Categories.Category', compact('events', 'category', 'client', 'liked_events', 'favorites', 'following'));
        }

        return view('Front.Categories.Category', compact('events', 'category'));


    }
}
