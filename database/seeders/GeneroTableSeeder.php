<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            ['genero' => 'HOMBRE', 'created_at' => now(), 'updated_at' => now()],
            ['genero' => 'MUJER', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('genero')->insert($generos);
    }
}
