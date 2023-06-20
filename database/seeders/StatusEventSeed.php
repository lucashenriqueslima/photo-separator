<?php

namespace Database\Seeders;

use App\Models\EventStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
