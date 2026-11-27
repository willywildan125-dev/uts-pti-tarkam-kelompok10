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
    Schema::create('games', function (Blueprint $table) {
        $table->id('id_game');
        $table->string('babak');                        // babak_12, perempat_final, semifinal, final
        $table->foreignId('klub_a_id')->nullable()->constrained('klubs', 'id_klub')->restrictOnDelete();
        $table->foreignId('klub_b_id')->nullable()->constrained('klubs', 'id_klub')->restrictOnDelete();
        $table->dateTime('jadwal')->nullable();
        $table->string('lapangan')->nullable();
        $table->unsignedTinyInteger('skor_a')->nullable();
        $table->unsignedTinyInteger('skor_b')->nullable();
        $table->unsignedTinyInteger('penalti_a')->nullable();
        $table->unsignedTinyInteger('penalti_b')->nullable();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('games'); }
};
