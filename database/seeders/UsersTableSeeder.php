<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Creando con un Seeder el usuario principal
        DB::table('users')->insert([
            [
                'id_region' => 5,
                'id_delegacion' => 138,
                'id_secretaria' => 16,
                'titulo' => 'PROF.',
                'nombre' => 'User',
                'apaterno' => 'Admin',
                'amaterno' => '',
                'id_genero' => 1,

                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,                
                'telefono' => '1111111111',
                'direccion' => 'capricornio #23',
                'cp' => '91000',
                'ciudad' => 'Xalapa',
                'estado' => 'Veracruz',

            ],
        ]);
    }
}
/*

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];



            $table->unsignedBigInteger('id_region');
            $table->unsignedBigInteger('id_delegacion');
            $table->unsignedBigInteger('id_secretaria');
            $table->string('titulo' , 150);
            $table->string('nombre' , 150);
            $table->string('apaterno' , 150);
            $table->string('amaterno' , 150);
            $table->unsignedBigInteger('id_genero');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            
            $table->string('telefono' , 20)->nullable()->default(null);
            $table->string('direccion' ,250)->nullable()->default(null);
            $table->string('cp' , 50)->nullable()->default(null);
            $table->string('ciudad' , 50)->nullable()->default(null);
            $table->string('estado' , 50)->nullable()->default(null);        

*/