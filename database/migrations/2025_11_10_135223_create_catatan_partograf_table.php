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
        Schema::create('catatan_partograf', function (Blueprint $table) {
            $table->string('id', 25)->primary();
            $table->string('waktu_catat', 25)->nullable();
            $table->decimal('djj')->nullable();
            $table->decimal('pembukaan_servik')->nullable();
            $table->decimal('penurunan_kepala')->nullable();
            $table->decimal('nadi_ibu')->nullable();
            $table->decimal('suhu_ibu')->nullable();
            $table->decimal('sistolik')->nullable();
            $table->decimal('diastolik')->nullable();
            $table->string('asisten', 25)->nullable();
            $table->string('protein', 25)->nullable();
            $table->decimal('volume_urine')->nullable();
            $table->string('obat_cairan', 25)->nullable();
            $table->string('makan', 25)->nullable();
            $table->string('partograf_id', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_partograf');
    }
};
