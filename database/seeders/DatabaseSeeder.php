<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_EN');

        $statuses = ['new', 'active', 'deleted', 'not confirmed', 'confirmed', 'completed', 'cancelled'];
        foreach ($statuses as $status) {
            DB::table('statuses')->insert([
                'status' => $status
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'vadim.mozeiko@gmail.com',
            'password' => Hash::make('1234'),
            'address' => $faker->address,
            'phone' => rand(100000000, 199999999),
            'isAdmin' => 1,
            'status_id' => 2,
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        foreach (range(1, 100) as $run) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'address' => $faker->address,
                'phone' => rand(100000000, 199999999),
//                'password' => Hash::make($faker->password(8, 12)),
                'password' => Hash::make('1234'),
                'isAdmin' => 0,
                'status_id' => rand(1, 2),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

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
                'short_description' => $faker->text(100),
                'description' => $faker->realTextBetween(500, 1000),
                'status_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

        foreach (range(1, 300) as $run) {
            $randomUser = User::all()->random(1)->first();
            $randomProduct = Product::all()->random(1)->first();
            DB::table('orders')->insert([
                'user_name' => $randomUser->name,
                'user_email' => $randomUser->email,
                'user_phone' => $randomUser->phone,
                'user_message' => $faker->text(200),
                'date' => $faker->dateTimeBetween($startDate = "now", $endDate = "60 days")->format('Y-m-d'),
                'status_id' => rand(4, 7),
                'price' => $randomProduct->price,
                'user_id' => $randomUser->id,
                'product_id' => $randomProduct->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
