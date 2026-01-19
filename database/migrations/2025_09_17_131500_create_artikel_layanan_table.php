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
        Schema::create('artikel_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->json('poin')->nullable();
            // meta badges di UI
            $table->unsignedSmallInteger('durasi_min')->nullable();
            $table->unsignedSmallInteger('durasi_maks')->nullable();
            $table->unsignedInteger('harga')->nullable(); // rupiah
            $table->unsignedInteger('suka')->default(0); // total likes
            $table->unsignedSmallInteger('garansi_hari')->nullable(); // hari
            // publikasi
            $table->boolean('dipublikasi')->default(true);
            $table->timestamp('tanggal_publikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_layanan');
    }
};
