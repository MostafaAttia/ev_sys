<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @access public
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id'            => 1,
                'name'          => 'Art & Theatre',
                'description'   => ''
            ],
            [
                'id'            => 2,
                'name'          => 'Exhibitions',
                'description'   => ''
            ],
            [
                'id'            => 3,
                'name'          => 'Music & Entertainment',
                'description'   => ''
            ],
            [
                'id'            => 4,
                'name'          => 'Networking & Social',
                'description'   => ''
            ],
            [
                'id'            => 5,
                'name'          => 'Nightlife',
                'description'   => ''
            ],
[
                'id'            => 6,
                'name'          => 'Food & Dining',
                'description'   => ''
            ],
[
                'id'            => 7,
                'name'          => 'Sport',
                'description'   => ''
            ],

        ]);
    }
}
