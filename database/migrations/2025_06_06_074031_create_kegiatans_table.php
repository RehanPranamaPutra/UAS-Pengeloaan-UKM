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
        Schema::create('rehan_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ukm_id')->constrained('rehan_ukms','id');
            $table->string('nama_kegiatan',50);
            $table->date('tgl_kegiatan');
            $table->enum('status',['Akan Datang','Sedang Berlangsung','Selesai']);
            $table->string('dokumentasi');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
