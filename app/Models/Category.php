<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Event;

class Category extends Model
{

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The events under this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }

}