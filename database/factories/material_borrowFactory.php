<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\material_borrow>
 */
class material_borrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // //** */
            // $table->id();
            // $table->integer('userId');
            // $table->string('material');//! should be material id , so we will use JOINS
            // $table->integer('quantity');
            // $table->date('dateBorrow');
            // $table->time('timeBorrow');

            'userId' => fake()->numberBetween($min = 4, $max = 4),
            'material'=>fake()->randomElement(["Ping-Pong","FootBall","BasketBall"]),
            'quantity'=>fake()->numberBetween($min = 1, $max = 10),
            'dateBorrow'=>fake()->date(),
            'timeBorrow'=>fake()->time(),




        ];
    }
}
