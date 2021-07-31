<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEndPoint()
    {

        $user = Auth::loginUsingId(1);

//        $response = $this->actingAs($user)
//            ->get('dashboard/orders/create');
        $response = $this->get('dashboard/orders/create');

            $response->assertStatus(200);
    }
}
