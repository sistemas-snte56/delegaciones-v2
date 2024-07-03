<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // #Campos originales
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->foreignId('current_team_id')->nullable();
            // $table->string('profile_photo_path', 2048)->nullable();
            // $table->timestamps();


            #Modificamos los campos que se requieren en Users
            $table->id();
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
            
            $table->timestamps();








        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
