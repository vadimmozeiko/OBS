<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->realTextBetween(100, 300),
            'status' => Contact::STATUS_NEW,
            'created_at' => $this->faker->dateTimeBetween("-3 days"),
        ];
    }
}
