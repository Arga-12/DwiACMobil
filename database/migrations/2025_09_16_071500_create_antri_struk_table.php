<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antri_struk', function (Blueprint $table) {
            $table->id('id_antri_struk');

            // Relations
            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan', 'id_pelanggan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('id_montir')
                ->nullable()
                ->constrained('montir', 'id_montir')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Metadata
            $table->string('nomor_booking')->unique();
            $table->text('catatan')->nullable();
            $table->string('status', 30)->default('pending'); // pending, waiting_confirm, confirmed, in_progress, completed, canceled

            // Timeline & duration
            $table->dateTime('tanggal_pesan')->useCurrent();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->unsignedInteger('durasi_hari')->nullable();

            // Pricing
            $table->unsignedBigInteger('harga_keseluruhan')->nullable();
            $table->unsignedBigInteger('admin_harga_total')->nullable();
            $table->json('admin_harga_rincian')->nullable(); // { layanan: [...], sparepart: [...], delivery: ... }
            $table->string('price_status', 20)->default('pending'); // pending, confirmed, rejected
            $table->dateTime('user_price_confirmed_at')->nullable();

            // Files / assets
            $table->string('bukti_struk')->nullable(); // path under public/

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antri_struk');
    }
};
