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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->string('area');
            $table->string('personal_asignado')->nullable();
            $table->string('descripcion');
            $table->string('fecha_estimada')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_final')->nullable();
            $table->integer('avance')->nullable()->default('0');
            $table->string('prioridad');
            $table->string('estado')->default('1');
            $table->string('imagenes')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
