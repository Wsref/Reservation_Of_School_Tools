<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservationm>
 */
class ReservationmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => $this->faker->numberBetween(1,15),
            'materiel_id' =>$this->faker->numberBetween(1,15),
            'quantite' => $this->faker->numberBetween(1, 10),
            'date_reserve' => $this->faker->dateTimeBetween('2024-02-01', '2024-03-15')->format('Y-m-d'),
            'valide' => $this->faker->randomElement([-1,1,0])
        ];
    }
}
