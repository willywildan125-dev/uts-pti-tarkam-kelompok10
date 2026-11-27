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
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('guest')->after('password');
        $table->foreignId('klub_id')->nullable()->after('role')
              ->constrained('klubs', 'id_klub')->nullOnDelete();
    });
}
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropConstrainedForeignId('klub_id');
        $table->dropColumn('role');
    });
}
};
