<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Mr', 'Mme', 'Mlle']),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'company' => $this->faker->company,
            'postal_code' => $this->faker->postcode,
            'cdt_status' => $this->faker->randomElement(['open', 'close','In Progress']),
            'created_by' => User::inRandomOrder()->first()->id,
            'position_id' => Position::inRandomOrder()->first()->id,
        ];
    }
}
