<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(['permanent', 'temporary']),
        ];
    }
}
