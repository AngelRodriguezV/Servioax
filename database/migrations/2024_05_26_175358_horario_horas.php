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
        Schema::create('horario_horas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('horario_id');
            $table->unsignedBigInteger('solicitud_id')->nullable();
            $table->time('hora');
            $table->enum('estatus', ['Libre','Reservada','En espera','Ocupado',"No Disponible"]);
            $table->timestamps();
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_horas');
    }
};
