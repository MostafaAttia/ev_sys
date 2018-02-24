<?php

use Illuminate\Database\Seeder;

class WeekDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weekdays')->insert([
            [
                'id'            => 1,
                'name'          => 'Monday'
            ],
            [
                'id'            => 2,
                'name'          => 'Tuesday'
            ],
            [
                'id'            => 3,
                'name'          => 'Wednesday'
            ],
            [
                'id'            => 4,
                'name'          => 'Thursday'
            ],
            [
                'id'            => 5,
                'name'          => 'Friday'
            ],
            [
                'id'            => 6,
                'name'          => 'Saturday'
            ],
            [
                'id'            => 7,
                'name'          => 'Sunday'
            ],

        ]);
    }
}
