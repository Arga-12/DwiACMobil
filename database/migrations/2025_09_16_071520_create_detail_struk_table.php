<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_struk', function (Blueprint $table) {
            $table->id('id_detail_struk');
            $table->foreignId('id_antri_struk')
                ->constrained('antri_struk', 'id_antri_struk')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // New: one-to-many from layanan -> detail_struk (nullable if item is sparepart/other)
            $table->foreignId('id_layanan')
                ->nullable()
                ->constrained('layanan', 'id_layanan')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('tipe', 20)->default('layanan'); // layanan, sparepart, delivery, lainnya
            $table->unsignedBigInteger('id_ref')->nullable(); // optional ref to other table id if not layanan
            $table->string('deskripsi', 255);
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedBigInteger('harga_satuan')->default(0);
            $table->unsignedBigInteger('subtotal')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_struk');
    }
};
