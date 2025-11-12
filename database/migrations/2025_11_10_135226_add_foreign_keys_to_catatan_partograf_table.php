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
        Schema::table('catatan_partograf', function (Blueprint $table) {
            $table->foreign(['partograf_id'], 'fk_catatan_partograf')->references(['id'])->on('partograf')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_partograf', function (Blueprint $table) {
            $table->dropForeign('fk_catatan_partograf');
        });
    }
};
