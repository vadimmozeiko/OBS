<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_EN');
        $images = [
            'https://astrojump.ca/wp-content/uploads/2014/04/camelot-castle.jpg',
            'https://astrojump.ca/wp-content/uploads/2014/04/spiderman.jpg',
            'https://astrojump.ca/wp-content/uploads/2018/08/midieval.jpg',
            'https://astrojump.ca/wp-content/uploads/2014/04/elmo.jpg',
            'https://astrojump.ca/wp-content/uploads/2017/04/Colour-Castle-small.jpg',
            'https://astrojump.ca/wp-content/uploads/2014/04/multi-color-castle.jpg'
        ];

        $titles = [
            'Camelot Castle',
            'Spiderman',
            'King’s Castle',
            'Elmo’s World',
            'Backyard Castle',
            'Multi-Colour Castle'
        ];

        $categories = [
            'Classic',
            'Funny',
            'Adventure'
        ];

        foreach ($images as $key => $product) {
            DB::table('products')->insert([
                'image' => $product,
                'category' => $categories[rand(0, count($categories) - 1)],
                'title' => $titles[$key],
                'price' => rand(6000, 9000),
                'description' => $faker->realTextBetween(100, 300),
                'status' => $faker->randomElement(Product::STATUSES),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
