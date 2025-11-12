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
        Schema::create('pasien', function (Blueprint $table) {
            $table->decimal('no_reg')->primary();
            $table->string('username', 25);
            $table->string('nama', 100);
            $table->string('password');
            $table->string('alamat', 25);
            $table->decimal('umur');
            $table->decimal('gravida');
            $table->decimal('paritas');
            $table->decimal('abortus');
            $table->string('bidan_id', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
