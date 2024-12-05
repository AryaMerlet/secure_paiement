<?php

namespace Database\Factories;

use App\Models\Paiement;
use App\Models\User;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paiement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(2, 10, 1000); // Generate a price between 10 and 1000
        // $refundedAmount = $this->faker->randomFloat(2, 0, $price); // Refunded amount should not exceed the price
        $user = User::inRandomOrder()->first();
        $card = Card::where('user_id', $user->id)->inRandomOrder()->first();

        if (!$card) {
            // Create a new card for the user if no card exists
            $card = Card::factory()->create(['user_id' => $user->id]);
        }
        return [
            'user_id' => $user->id,
            'card_id' => $card->id,
            'price' => $price,
            // 'refunded_amount' => $refundedAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
