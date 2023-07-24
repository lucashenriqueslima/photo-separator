<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'client_id' => 1,
            'name' => 'Admin',
            'email' => 'lucashenrique_fera@hotmail.com',
            'password' => '12345678', // password
            'is_admin' => true,
        ]);
        User::factory(10)->create();
    }
}
