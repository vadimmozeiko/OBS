<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_EN');
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'vadim.mozeiko@gmail.com',
            'password' => Hash::make('1234'),
            'address' => $faker->address,
            'phone' => rand(100000000, 199999999),
            'isAdmin' => 1,
            'status' => User::STATUS_ACTIVE,
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        User::factory()->count(100)->create();

    }
}
