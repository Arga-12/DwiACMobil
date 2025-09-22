<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id_layanan');

            // Kategori (nullable supaya backward compatible)
            $table->foreignId('id_kategori')
                ->nullable()
                ->constrained('layanan_kategori', 'id_kategori')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('nama', 150);
            $table->unsignedBigInteger('harga_default')->nullable(); // nullable, akan diisi montir/admin nanti
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
