<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_struk', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_detail_struk');

            // Use explicit column + FK to avoid strict MySQL FK formation issues
            $table->unsignedBigInteger('id_antri_struk');
            $table->foreign('id_antri_struk', 'fk_detail_struk_antri')
                ->references('id_antri_struk')->on('antri_struk')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // One-to-many from layanan -> detail_struk (requires layanan table exists already)
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
