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
        Schema::create('rehan_capaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ukm_id')->constrained('rehan_ukms','id');
            $table->foreignId('anggota_id')->constrained('rehan_anggotas','id');
            $table->string('judul_prestasi',50);
            $table->text('deskripsi_prestasi')->nullable();
            $table->date('tanggal');
            $table->enum('tingkat',['Kampus','Regional','Nasional','Internasional']);
            $table->string('dokumentasi_capaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaians');
    }
};
