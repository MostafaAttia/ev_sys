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
                'description'   => '',
                'img_path'      => asset('/front/img/categories/art.jpg')
            ],
            [
                'id'            => 2,
                'name'          => 'Exhibitions',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/exhibition.jpg')
            ],
            [
                'id'            => 3,
                'name'          => 'Music & Entertainment',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/music.jpg')
            ],
            [
                'id'            => 4,
                'name'          => 'Networking & Social',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/social.jpg')
            ],
            [
                'id'            => 5,
                'name'          => 'Nightlife',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/nightlife.jpg')
            ],
[
                'id'            => 6,
                'name'          => 'Food & Dining',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/food.jpg')
            ],
[
                'id'            => 7,
                'name'          => 'Sports',
                'description'   => '',
                'img_path'      => asset('/front/img/categories/sports.jpg')
            ],

        ]);
    }
}
