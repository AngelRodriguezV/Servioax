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
        Schema::create('dias_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('dia_semana');
            $table->integer('N');
            $table->unsignedBigInteger('proveedor_id');
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dias_trabajos');
    }
};
