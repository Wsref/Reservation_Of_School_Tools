<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
                                                            // \App\Models\User::factory(10)->create();

        // \App\Models\individuals::factory(20)->create();
        // \App\Models\material_borrow::factory(100)->create();
                                                            // \App\Models\users::factory()->count(10)->create();
                                                            // \App\Models\messages::factory(200)->create();
            // \App\Models\user_messages::factory(50)->create();
            // \App\Models\admin_messages::factory(20)->create();
            // \App\Models\materiels::factory(30)->create();

            \App\Models\Reservationm::factory(40)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
