<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orders = Order::all()->random(1)->first();

        return [
            'order_id' => $orders->id,
            'event' => $this->faker->realTextBetween(10, 50),
            'status' => Notification::STATUS_NEW,
            'created_at' => $this->faker->dateTimeBetween("-3 days"),
        ];
    }
}
