<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GeneroTableSeeder;
use Database\Seeders\RegionesTableSeeder;
use Database\Seeders\SecretariasTableSeeder;
use Database\Seeders\DelegacionCtTableSeeder;
use Database\Seeders\DelegacionesTableSeeder;
use Database\Seeders\NomenclaturasTableSeeder;
use Database\Seeders\TipoDelegacionTableSeeder;

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
            // RegionesTableSeeder::class,
            // GeneroTableSeeder::class,
            // DelegacionCtTableSeeder::class,
            // TipoDelegacionTableSeeder::class,
            // NomenclaturasTableSeeder::class,
            // SecretariasTableSeeder::class,
            DelegacionesTableSeeder::class,
        ]);
    }
}
