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
                'name'          => 'Monday',
                'short'          => 'mon'
            ],
            [
                'id'            => 2,
                'name'          => 'Tuesday',
                'short'          => 'tues'
            ],
            [
                'id'            => 3,
                'name'          => 'Wednesday',
                'short'          => 'wed'
            ],
            [
                'id'            => 4,
                'name'          => 'Thursday',
                'short'          => 'thurs'
            ],
            [
                'id'            => 5,
                'name'          => 'Friday',
                'short'          => 'fri'
            ],
            [
                'id'            => 6,
                'name'          => 'Saturday',
                'short'          => 'sat'
            ],
            [
                'id'            => 7,
                'name'          => 'Sunday',
                'short'          => 'sun'
            ],

        ]);
    }
}
