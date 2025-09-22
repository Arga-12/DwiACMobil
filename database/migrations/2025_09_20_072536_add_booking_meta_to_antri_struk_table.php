<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            // durasi_hari: default 1 (1 hari)
            if (!Schema::hasColumn('antri_struk', 'durasi_hari')) {
                $table->tinyInteger('durasi_hari')->default(1)->after('tanggal_selesai');
            }

            // menginap: default 0 (false)
            if (!Schema::hasColumn('antri_struk', 'menginap')) {
                $table->boolean('menginap')->default(0)->after('durasi_hari');
            }

            // jam_booking: tanggal mulai (nullable)
            if (!Schema::hasColumn('antri_struk', 'jam_booking')) {
                $table->date('jam_booking')->nullable()->after('menginap');
            }

            // jam_selesai: tanggal selesai (nullable)
            if (!Schema::hasColumn('antri_struk', 'jam_selesai')) {
                $table->date('jam_selesai')->nullable()->after('jam_booking');
            }
        });
    }

    public function down(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            // Aman untuk rollback: drop jika kolom ada
            if (Schema::hasColumn('antri_struk', 'jam_selesai')) {
                $table->dropColumn('jam_selesai');
            }
            if (Schema::hasColumn('antri_struk', 'jam_booking')) {
                $table->dropColumn('jam_booking');
            }
            if (Schema::hasColumn('antri_struk', 'menginap')) {
                $table->dropColumn('menginap');
            }
            if (Schema::hasColumn('antri_struk', 'durasi_hari')) {
                $table->dropColumn('durasi_hari');
            }
        });
    }
};