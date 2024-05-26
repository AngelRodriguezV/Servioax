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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('direccion_id');
            $table->date('fecha');
            $table->time('hora');
            $table->$table->integer('tiempo_aproximado')->unsigned()->nullable()->default(1);
            $table->enum('tiempo_medida', ['dias','horas','minutos']);
            $table->decimal('costo', 8, 2);
            $table->enum('estatus', ['NUEVA','EN REVISION','ACEPTADA','RECHAZADA','EN PROCESO','COMPLETADA','CANCELADA']);
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
