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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('calle');
            $table->string('colonia');
            $table->string('municipio');
            $table->string('estado');
            $table->integer('num_interior')->nullable(false);
            $table->integer('num_exterior');
            $table->integer('codigo_postal');
            $table->string('referencias');
            $table->string('entre_calle1')->nullable(false);
            $table->string('entre_calle2')->nullable(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
