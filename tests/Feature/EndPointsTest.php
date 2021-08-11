<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EndPointsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_access_home_path()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_can_access_products_path()
    {
        $response = $this->get('/products/all');
        $response->assertStatus(200);
    }

    public function test_can_access_faq_path()
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
    }

    public function test_can_access_contact_path()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_can_access_product_details_path()
    {
        $product = Product::all()->random()->first();
        $response = $this->get("/products/show/$product->id");
        $response->assertStatus(200);
    }


}
