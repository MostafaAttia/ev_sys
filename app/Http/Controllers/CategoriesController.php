<?php

namespace App\Http\Controllers;

use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ClientTransformer;
use App\Models\Category;
use Illuminate\Http\Request;
use League\Fractal;
use Auth;

class CategoriesController extends Controller
{
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

            return view('Front.Client.Categories', compact('categories', 'favorites', 'client'));
        }

        return view('Front.Client.Categories', compact('categories'));
    }
}
