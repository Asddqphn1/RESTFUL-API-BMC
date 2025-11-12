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
        Schema::table('konten_edukasi', function (Blueprint $table) {
            $table->foreign(['bidan_id'], 'fk_konten_bidan')->references(['id'])->on('bidan')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konten_edukasi', function (Blueprint $table) {
            $table->dropForeign('fk_konten_bidan');
        });
    }
};
