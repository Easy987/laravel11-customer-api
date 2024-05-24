<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'contact_type' => $this->faker->randomElement(['email', 'phone']),
            'contact' => $this->faker->unique()->safeEmail,
        ];
    }
}
