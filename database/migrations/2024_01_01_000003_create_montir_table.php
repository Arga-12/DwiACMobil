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
        Schema::create('montir', function (Blueprint $table) {
            $table->id('id_montir');
            $table->string('nama', 150);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_wa', 30)->nullable();
            $table->string('facebook')->nullable();
            $table->string('peran', 50)->default('montir');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable(); // Kolom foto profile
            $table->datetime('tgl_dibuat')->default(now());
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montir');
    }
};
