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
        Schema::create('historial_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente'); // id_cliente BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('id_prov_serv'); // id_prov_serv BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('id_direccion'); // id_direccion BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('id_valoracion'); // id_valoracion BIGINT UNSIGNED NOT NULL
            $table->date('fecha'); // fecha DATE
            $table->time('hora'); // hora TIME
            $table->text('descripccion'); // descripccion TEXT

            // Definición de claves foráneas
            $table->foreign('id_cliente')->references('id')->on('users');
            $table->foreign('id_prov_serv')->references('id')->on('users');
            $table->foreign('id_direccion')->references('id')->on('direcciones');
            $table->foreign('id_valoracion')->references('id')->on('valoraciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_servicios');
    }
};
