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
        Schema::create('ciclos_formativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_profesional_id')->constrained('familias_profesionales')->cascadeOnDelete();

            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->enum('grado', ['medio', 'superior']);

              $table->string('slug')->unique();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos_formativos');
    }
};
