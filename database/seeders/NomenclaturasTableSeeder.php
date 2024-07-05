<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NomenclaturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomenclaturas = [
            ['nomenclatura' => 'D-I-', 'id_tipo_delegacion' => 1,   'created_at'  => now(), 'updated_at' => now()],
            ['nomenclatura' => 'D-II-', 'id_tipo_delegacion' => 1,   'created_at'  => now(), 'updated_at' => now()],
            ['nomenclatura' => 'D-III-', 'id_tipo_delegacion' => 1,   'created_at'  => now(), 'updated_at' => now()],
            ['nomenclatura' => 'D-IV-', 'id_tipo_delegacion' => 2,   'created_at'  => now(), 'updated_at' => now()],
            ['nomenclatura' => 'C.T.', 'id_tipo_delegacion' => 3,   'created_at'  => now(), 'updated_at' => now()],
        ];

        DB::table('nomenclatura')->insert($nomenclaturas);
    }
}