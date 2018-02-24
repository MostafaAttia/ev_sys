<?php
namespace App\Models;

use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use CanBeFavorited;

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