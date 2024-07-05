<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DelegacionCtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deleg_ct = [
            ['deleg_ct' => 'DELEGACIÓN', 'created_at' => now(), 'updated_at' => now()],
            ['deleg_ct' => 'CENTRO DE TRABAJO', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('delegacion_o_ct')->insert($deleg_ct);
    }
}
