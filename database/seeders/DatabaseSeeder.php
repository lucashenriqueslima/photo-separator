<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Database\Seeders\EventStatusSeed;
use Database\Seeders\EventSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // ClientSeeder::class,
            // UserSeeder::class,
            // EventStatusSeed::class,

            // EventSeeder::class,
            CollectionSeeder::class,
        ]);
    }
}
