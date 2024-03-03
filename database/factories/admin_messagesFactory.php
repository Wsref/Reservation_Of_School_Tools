<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin_messages>
 */
class admin_messagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $table->id('reply_id');
            // $table->integer('replier_id');
            // $table->integer('replies_to_id');
            // $table->integer('replies_to_request_id') ;
            // $table->text('reply_msg');
            // $table->integer('response_status') ;
            // $table->date('reply_date');
            // $table->time('reply_time');
            // $table->timestamp('reply_timestamp');

            'replier_id' => fake()->randomElement([1]),
            'replies_to_id' => fake()->numberBetween(1,20)  ,
            'replies_to_request_id' => fake()->numberBetween(1,50),
            'reply_msg' => fake()->text(30),
            'response_status' => fake()->randomElement([0,1]),

            'reply_date' => fake()->date(),
            'reply_time' => fake()->time(),
            'reply_timestamp' => fake()->dateTime(),
            //
        ];
    }
}
