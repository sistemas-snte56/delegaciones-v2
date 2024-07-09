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
            $table->unsignedBigInteger('id_region');
            $table->unsignedBigInteger('id_delegacion');
            $table->unsignedBigInteger('id_secretaria');
            $table->string('titulo' , 255);
            $table->string('nombre' , 255);
            $table->string('apaterno' , 255);
            $table->string('amaterno' , 255)->nullable()->default(null);
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

            $table->foreign('id_region')->references('id')->on('regiones');
            $table->foreign('id_delegacion')->references('id')->on('delegaciones');
            $table->foreign('id_secretaria')->references('id')->on('secretarias');
            $table->foreign('id_genero')->references('id')->on('genero');

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
