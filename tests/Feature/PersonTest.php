<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_person(): void
    {
        $response = $this->postJson('/api/persons', [
            'name' => 'John Doe',
            'addresses' => [
                ['address' => '123 Main St', 'type' => 'permanent'],
                ['address' => '456 Elm St', 'type' => 'temporary']
            ],
            'contacts' => [
                ['contact_type' => 'email', 'contact' => 'john@example.com'],
                ['contact_type' => 'phone', 'contact' => '1234567890']
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'name', 'addresses' => [
                    '*' => ['id', 'person_id', 'address', 'type']
                ],
                'contacts' => [
                    '*' => ['id', 'person_id', 'contact_type', 'contact']
                ]
            ]);
    }

    public function test_can_create_person_with_single_address(): void
    {
        $response = $this->postJson('/api/persons', [
            'name' => 'John Doe',
            'addresses' => [
                ['address' => '123 Main St', 'type' => 'permanent']
            ],
            'contacts' => [
                ['contact_type' => 'email', 'contact' => 'john@example.com'],
                ['contact_type' => 'phone', 'contact' => '1234567890']
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'name', 'addresses' => [
                    '*' => ['id', 'person_id', 'address', 'type']
                ],
                'contacts' => [
                    '*' => ['id', 'person_id', 'contact_type', 'contact']
                ]
            ]);
    }

    public function test_validation_error_on_create_person_with_more_than_two_addresses(): void
    {
        $response = $this->postJson('/api/persons', [
            'name' => 'John Doe',
            'addresses' => [
                ['address' => '123 Main St', 'type' => 'permanent'],
                ['address' => '456 Elm St', 'type' => 'temporary'],
                ['address' => '789 Oak St', 'type' => 'temporary']
            ],
            'contacts' => [
                ['contact_type' => 'email', 'contact' => 'john@example.com'],
                ['contact_type' => 'phone', 'contact' => '1234567890']
            ]
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['addresses']);
    }

    public function test_can_get_all_persons(): void
    {
        Person::factory()->count(5)->create();

        $response = $this->getJson('/api/persons');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function test_can_get_single_person(): void
    {
        $person = Person::factory()->create();

        $response = $this->getJson('/api/persons/' . $person->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id', 'name', 'addresses', 'contacts'
            ]);
    }

    public function test_can_update_person(): void
    {
        $person = Person::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'addresses' => [
                ['address' => '789 Maple St', 'type' => 'permanent'],
                ['address' => '101 Oak St', 'type' => 'temporary']
            ],
            'contacts' => [
                ['contact_type' => 'email', 'contact' => 'jane@example.com'],
                ['contact_type' => 'phone', 'contact' => '9876543210']
            ]
        ];

        $response = $this->putJson('/api/persons/' . $person->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Jane Doe'
            ]);
    }

    public function test_validation_error_on_update_person_with_more_than_two_addresses(): void
    {
        $person = Person::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'addresses' => [
                ['address' => '789 Maple St', 'type' => 'permanent'],
                ['address' => '101 Oak St', 'type' => 'temporary'],
                ['address' => '102 Pine St', 'type' => 'temporary']
            ],
            'contacts' => [
                ['contact_type' => 'email', 'contact' => 'jane@example.com'],
                ['contact_type' => 'phone', 'contact' => '9876543210']
            ]
        ];

        $response = $this->putJson('/api/persons/' . $person->id, $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['addresses']);
    }

    public function test_can_delete_person(): void
    {
        $person = Person::factory()->create();

        $response = $this->deleteJson('/api/persons/' . $person->id);

        $response->assertStatus(204);
    }

    public function test_person_not_found(): void
    {
        $response = $this->getJson('/api/persons/999');

        $response->assertStatus(404);
    }
}
