<?php

namespace App\Api\V1\Transformers;

use App\Models\Event;
use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {

        $events = Event::where(['category_id' => $category->id, 'is_live'=> 1])
            ->where('end_date', '>', date("Y-m-d H:i:s"))->get()->toArray();

        $events_counter  = count($events);

        $categories = [
            'id'            => $category->id,
            'name'          => $category->name,
            'name_slug'     => str_slug($category->name, '-'),
            'image_path'    => $category->img_path,
            'events'        => $events_counter,
            'fans'          => $category->favoriters()->get()->count()
        ];

        return $categories;
    }
}