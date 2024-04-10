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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('remitente_id');
            $table->unsignedBigInteger('conversacion_id');
            $table->string('mensaje');
            $table->enum('estatus', ['enviado', 'entregado', 'leido']);
            $table->timestamps();
            $table->foreign('remitente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conversacion_id')->references('id')->on('conversaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
