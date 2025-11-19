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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->text('description')->nullable();
            $table->json('points')->nullable();
            // meta badges di UI
            $table->unsignedSmallInteger('duration_min')->nullable();
            $table->unsignedSmallInteger('duration_max')->nullable();
            $table->unsignedInteger('price')->nullable(); // rupiah
            $table->unsignedInteger('likes')->default(0); // total likes
            $table->unsignedSmallInteger('guarantee_days')->nullable(); // hari
            // publikasi
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
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
