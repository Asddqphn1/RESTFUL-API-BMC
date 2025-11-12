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
        Schema::table('persalinan', function (Blueprint $table) {
            $table->foreign(['partograf_id'], 'fk_persalinan_partograf')->references(['id'])->on('partograf')->onUpdate('no action')->onDelete('set null');
            $table->foreign(['pasien_no_reg'], 'fk_persalinan_pasien')->references(['no_reg'])->on('pasien')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persalinan', function (Blueprint $table) {
            $table->dropForeign('fk_persalinan_partograf');
            $table->dropForeign('fk_persalinan_pasien');
        });
    }
};
