<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        $categories = [
            'id'        => $category->id,
            'name'      => $category->name,
            'name_slug' => str_slug($category->name, '-')
        ];

        return $categories;
    }
}