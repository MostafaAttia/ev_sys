<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 200)->create()->each(function ($u) {
            $u->images()->save(factory(App\Models\EventImage::class, 1)->make());
        });
    }
}
