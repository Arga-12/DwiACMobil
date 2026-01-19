<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("rating", function (Blueprint $table) {
            $table->id("id_rating");
            $table->string("email");
            $table
                ->tinyInteger("bintang")
                ->unsigned()
                ->comment("1-5 star rating");
            $table->text("ulasan");
            $table->unsignedBigInteger("id_pelanggan");
            $table->timestamps();

            // Foreign key constraint
            $table
                ->foreign("id_pelanggan")
                ->references("id_pelanggan")
                ->on("pelanggan")
                ->onDelete("cascade");

            // Index for better performance
            $table->index("id_pelanggan");
            $table->index("bintang");
            $table->index("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("rating");
    }
};
