<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventStatus;

class EventStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventStatus::insert([
            [
                'title' => 'Aguardando Realização'
            ],
            [
                'title' => 'Realizado'
            ],
            [
                'title' => 'Cancelado'
            ]
        ]);
    }
}
