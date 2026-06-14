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
        Schema::create('ciclo_formativo_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciclo_formativo_id')->constrained('ciclos_formativos')->cascadeOnDelete();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->cascadeOnDelete();
            $table->unique(['ciclo_formativo_id', 'estudiante_id'], 'ciclo_estudiante_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclo_formativo_estudiante');
    }
};
