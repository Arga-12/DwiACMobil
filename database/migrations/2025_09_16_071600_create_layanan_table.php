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
            $table->string('nama', 150);
            $table->unsignedBigInteger('harga_default')->nullable(); // nullable, will be set by montir later
            $table->unsignedInteger('perkiraan_durasi_menit')->nullable();
            $table->string('icon')->nullable(); // optional icon path under public/
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
