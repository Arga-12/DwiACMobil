<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id('id_mobil');
            $table->string('nama_mobil', 100);
            $table->string('jenis_mobil', 50);
            $table->string('plat_nomor', 20)->unique();
            $table->unsignedBigInteger('id_pelanggan');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
