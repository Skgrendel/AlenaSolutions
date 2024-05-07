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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('objetivo')->nullable();
            $table->foreignId('preguntas_id')->constrained();
            $table->foreignId('grupodiagnosticos_id')->constrained();
            $table->unsignedBigInteger('calificaciones_id');
            $table->string('observacion')->nullable();
            $table->foreign('calificaciones_id')->references('id')->on('calificaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
