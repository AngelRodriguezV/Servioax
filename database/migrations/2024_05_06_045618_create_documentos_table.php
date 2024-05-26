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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->enum('estatus', ['NUEVA','EN REVISION','ACEPTADA','RECHAZADA']);
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('url_ine')->nullable();
            $table->string('url_domicilio')->nullable();
            $table->timestamps();
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
