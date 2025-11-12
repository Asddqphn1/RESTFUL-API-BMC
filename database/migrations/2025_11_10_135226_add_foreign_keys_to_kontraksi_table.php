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
        Schema::table('kontraksi', function (Blueprint $table) {
            $table->foreign(['catatan_partograf_id'], 'fk_kontraksi_catatan')->references(['id'])->on('catatan_partograf')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontraksi', function (Blueprint $table) {
            $table->dropForeign('fk_kontraksi_catatan');
        });
    }
};
