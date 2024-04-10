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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('tipo', ['solicitud', 'actualización', 'recordatorio', 'mensaje', 'oferta', 'alerta', 'confirmacion', 'error', 'aviso']);
            $table->string('titulo');
            $table->string('mensaje');
            $table->time('hora');
            $table->date('fecha');
            $table->enum('estatus', ['leida', 'pendiente', 'no leída', 'archivada']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
