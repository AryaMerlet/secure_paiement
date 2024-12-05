<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->creditCardNumber(),
            'expiration_date' => fake()->creditCardExpirationDate(),
            'name' => fake()->creditCardDetails()['name'],
            'type' => fake()->creditCardType(),
            'code' => random_int(100,999),
            'user_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
