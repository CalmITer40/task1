<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@admin.ru',
             'role' => config('products.role'),
             'password' => '$2y$10$RFfdd5AvF7j5s7aIXO7P6Or8R/tUivOQbO05h0Az37qhnSmdDjuO2'
         ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.ru',
            'password' => '$2y$10$RFfdd5AvF7j5s7aIXO7P6Or8R/tUivOQbO05h0Az37qhnSmdDjuO2'
        ]);
    }
}
