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
        Schema::create('rehan_ukms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ukm',50);
            $table->string('ketum',25);
            $table->string('logo_ukm');
            $table->text('deskripsi');
            $table->date('thn_berdiri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukms');
    }
};
