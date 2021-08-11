<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private array $order;

    public function createOrder()
    {
        $product = Product::all()->random(1)->first();
        $this->order = [
            'order_number' => rand(100000, 999999),
            'name' => $this->faker->name,
            'email' => 'test' . rand(10000, 9999999999) . '@test.com',
            'phone' => rand(100000000, 999999999),
            'address' => $this->faker->address,
            'message' => $this->faker->text(100),
            'date' => $this->faker->dateTimeBetween("now","60 days")->format('Y-m-d'),
            'status' => Order::STATUS_NOT_CONFIRMED,
            'price' => $product->price,
            'user_id' => null,
            'product_id' => $product->id,
            'invoice' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
    }

    public function test_guest_can_make_an_order()
    {
        $this->createOrder();

        $response = $this->post(route('order.store'), $this->order);

        $response->assertRedirect(route('order.index'));

        $this->assertDatabaseHas('orders', ['order_number' => $this->order['order_number']]);
    }

    public function test_user_can_make_an_order()
    {
        $user = User::all()->random(1)->first();
        $product = Product::all()->random(1)->first();

        $order = [
            'order_number' => rand(100000, 999999),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'message' => $this->faker->text(100),
            'date' => $this->faker->dateTimeBetween("now","60 days")->format('Y-m-d'),
            'status' => Order::STATUS_NOT_CONFIRMED,
            'price' => $product->price,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'invoice' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $response = $this->post(route('order.store'), $order);

        $response->assertRedirect(route('order.index'));

        $this->assertDatabaseHas('orders', ['order_number' => $order['order_number']]);
    }
}
