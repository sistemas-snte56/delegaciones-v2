<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoDelegacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo' => 'ACTIVOS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'JUBILADOS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'CENTRO DE TRABAJO', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipo_delegacion')->insert($tipos);
    }
}