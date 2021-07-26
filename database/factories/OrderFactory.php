<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUser = User::all()->random(1)->first();
        $randomProduct = Product::all()->random(1)->first();
        $year = Carbon::now()->year;
        return [
            'order_number' => $year . $this->faker->numberBetween(100000, 900000),
            'name' => $randomUser->name,
            'email' => $randomUser->email,
            'phone' => $randomUser->phone,
            'message' => $this->faker->text(200),
            'address' => $randomUser->address,
            'date' => $this->faker->dateTimeBetween($startDate = "now", $endDate = "60 days")->format('Y-m-d'),
            'status' => $this->faker->randomElement(Order::STATUSES),
            'price' => $randomProduct->price,
            'user_id' => $randomUser->id,
            'product_id' => $randomProduct->id,
            'created_at' => date("Y-m-d H:i:s"),
        ];
    }
}
