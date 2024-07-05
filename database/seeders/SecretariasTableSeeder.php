<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SecretariasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secretarias = [
            ['cartera_secretaria' => 'SECRETARÍA GENERAL	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE ORGANIZACIÓN	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE TRABAJO Y CONFLICTOS	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE FINANZAS	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE PREVISIÓN Y ASISTENCIA SOCIAL	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE ESCALAFÓN Y PROMOCIÓN	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE ORIENTACIÓN IDEOLÓGICA SINDICAL	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA GENERAL	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE ORGANIZACIÓN	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE FINANZAS	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE PREVISIÓN Y ASISTENCIA SOCIAL	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE ORIENTACIÓN IDEOLÓGICA SINDICAL	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE CULTURA Y RECREACIÓN	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'SECRETARÍA DE VINCULACIÓN SOCIAL Y PROGRAMAS PRODUCTIVOS	', 'id_nomenclatura' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'REPRESENTANTE SINDICAL DE CENTRO DE TRABAJO	', 'id_nomenclatura' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['cartera_secretaria' => 'COORDINADOR	', 'id_nomenclatura' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('secretarias')->insert($secretarias);
    }
}