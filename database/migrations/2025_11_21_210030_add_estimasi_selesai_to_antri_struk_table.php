<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            $table->dateTime('estimasi_selesai')->nullable()->after('tanggal_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            $table->dropColumn('estimasi_selesai');
        });
    }
};