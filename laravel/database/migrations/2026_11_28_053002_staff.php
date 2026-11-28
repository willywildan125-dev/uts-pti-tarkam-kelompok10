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
        Schema::create('staff', function (Blueprint $table) {
            $table->integer('Id_staff', true);
            $table->string('Nama_staff', 30);
            $table->string('Jabatan', 30);
            $table->integer('Id_tim')->nullable();
            $table->foreign('Id_tim')->references('id_tim')->on('tim')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
