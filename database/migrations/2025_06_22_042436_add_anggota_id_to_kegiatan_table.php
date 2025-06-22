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
        Schema::table('rehan_kegiatans', function (Blueprint $table) {
            $table->foreignId('anggota_id')->constrained('rehan_anggotas','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rehan_kegiatans', function (Blueprint $table) {
            //
        });
    }
};
