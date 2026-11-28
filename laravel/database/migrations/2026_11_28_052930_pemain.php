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
       Schema::create('pemain', function (Blueprint $table) {
            $table->integer('Id_pemain', true);
            $table->string('Nama_pemain', 30)->unique();
            $table->string('Posisi', 30);
            $table->integer('No_punggung');
            $table->enum('Status', ['aktif', 'cedera', 'sakit']);
            $table->enum('Sanksi', ['kartu_kuning', 'kartu_merah'])->nullable();
            $table->integer('Id_tim')->nullable();
            $table->foreign('Id_tim')->references('id_tim')->on('tim')->cascadeOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemain');
    }
};
