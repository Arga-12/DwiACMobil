<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            if (Schema::hasColumn('antri_struk', 'menginap')) {
                $table->dropColumn('menginap');
            }
            if (Schema::hasColumn('antri_struk', 'durasi_hari')) {
                $table->dropColumn('durasi_hari');
            }
        });
    }

    public function down(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            if (!Schema::hasColumn('antri_struk', 'durasi_hari')) {
                $table->unsignedInteger('durasi_hari')->nullable()->after('tanggal_selesai');
            }
            if (!Schema::hasColumn('antri_struk', 'menginap')) {
                $table->boolean('menginap')->default(0)->after('durasi_hari');
            }
        });
    }
};