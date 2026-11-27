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
    Schema::create('pemains', function (Blueprint $table) {
        $table->id('id_pemain');
        $table->foreignId('klub_id')->constrained('klubs', 'id_klub')->cascadeOnDelete();
        $table->string('nama_pemain');
        $table->unsignedTinyInteger('no_punggung');
        $table->string('posisi'); // GK, DF, MF, FW
        $table->timestamps();
        $table->unique(['klub_id', 'no_punggung']);
    });
}
public function down(): void { Schema::dropIfExists('pemains'); }
};
