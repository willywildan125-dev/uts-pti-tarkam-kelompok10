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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('Id_user', true);
            $table->string('Nama_user', 30);
            $table->string('password', 255);
            $table->string('email', 30)->unique();
            $table->enum('role', ['operator', 'manager']);
            $table->integer('Id_tim')->nullable();
            $table->foreign('Id_tim')->references('id_tim')->on('tim')->nullOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
