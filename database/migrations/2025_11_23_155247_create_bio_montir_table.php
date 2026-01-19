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
        Schema::create('bio_montir', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('peringkat')->nullable();
            $table->string('email')->unique();
            $table->string('nomor_telepon')->nullable();
            $table->text('kutipan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_montir');
    }
};
