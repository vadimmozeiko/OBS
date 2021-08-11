<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    private array $user;

    public function createUser()
    {
        $this->user = User::create([
            'name' => 'Test',
            'email' => 'test' . rand(0,1000000) . '@test.com',
            'password' => bcrypt('testpass'),
            'address' => '77458 Carter Brooks Suite 104 Bruenchester, ND 00817-8989',
            'phone' => rand(100000000, 199999999),
            'isAdmin' => 0,
            'status' => User::STATUS_ACTIVE,
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ])->toArray();
    }

    public function test_user_can_register()
    {
        $this->createUser();

        $response = $this->post('/register', $this->user);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'address' => $this->user['address'],
            'phone' => $this->user['phone'],
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::all()->random(1)->first();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '1234'
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }
}
