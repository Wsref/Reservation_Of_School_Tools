<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class materielsFactory extends Factory
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
            // $table->id();
            // $table->string('name');
            // $table->string('image');
            // $table->string('category');
            // $table->integer('quantite');

            // 'userId' => fake()->numberBetween($min = 1, $max = 20),
            'name'=>fake()->randomElement(["Ping-Pong","FootBall","BasketBall","gilets","barres","siflets","chbbka d basket"]),
            'image'=>fake()->imageUrl(),
            'category'=>fake()->randomElement(["Ping-Pong","FootBall","BasketBall","autre"]),
            'quantite'=>fake()->numberBetween($min = 1, $max = 10),
            // 'dateBorrow'=>fake()->date(),
            // 'timeBorrow'=>fake()->time(),
        ];
    }
}
