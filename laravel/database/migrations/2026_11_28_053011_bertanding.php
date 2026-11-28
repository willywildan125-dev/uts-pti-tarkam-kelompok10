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
        Schema::create('bertanding', function (Blueprint $table) {
            $table->integer('Id_game');
            $table->integer('Id_tim');
            $table->integer('Skor')->nullable();
            $table->integer('Penalti')->nullable();
            $table->primary(['Id_game', 'Id_tim']);
            $table->foreign('Id_game')->references('Id_game')->on('game')->cascadeOnDelete();
            $table->foreign('Id_tim')->references('id_tim')->on('tim')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bertanding');
    }
};
