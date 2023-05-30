<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->state([
            'name' => 'Rayandson Silva',
            'email' => 'rayandson.silva321@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin'
        ])->create();
    }
}
