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
        Schema::create('grupodiagnosticos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nombre_grupo');
            $table->string('descripcion_grupo');
            $table->string('nombre_empresa');
            $table->string('nit_empresa');
            $table->string('correo_empresa');
            $table->string('direccion_empresa')->nullable( );
            $table->string('direccion_empresa2')->nullable( );
            $table->string('telefono_fijo')->nullable( );
            $table->string('telefono_celular')->nullable( );
            $table->string('nombre_oficial_cumplimiento')->nullable( );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupodiagnosticos');
    }
};
