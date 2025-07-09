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
            $table->string('nama_ukm', 50)->unique();
            $table->string('slug')->unique();
            $table->string('ketum', 50)->nullable();
            $table->string('logo_ukm', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('website')->nullable();
            $table->date('thn_berdiri')->nullable();
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
