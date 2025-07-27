<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['name' => 'Table 1', 'capacity' => 2, 'location' => 'Terrasse', 'description' => 'Table romantique avec vue sur le jardin'],
            ['name' => 'Table 2', 'capacity' => 4, 'location' => 'Salon', 'description' => 'Table familiale dans le salon principal'],
            ['name' => 'Table 3', 'capacity' => 6, 'location' => 'Salon', 'description' => 'Grande table pour groupes'],
            ['name' => 'Table 4', 'capacity' => 2, 'location' => 'Bar', 'description' => 'Table haute près du bar'],
            ['name' => 'Table 5', 'capacity' => 4, 'location' => 'Terrasse', 'description' => 'Table extérieure couverte'],
            ['name' => 'Table 6', 'capacity' => 8, 'location' => 'Salon', 'description' => 'Table pour grandes occasions'],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
