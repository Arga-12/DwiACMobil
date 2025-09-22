<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            // Drop if columns exist
            if (Schema::hasColumn('antri_struk', 'jam_booking')) {
                $table->dropColumn('jam_booking');
            }
            if (Schema::hasColumn('antri_struk', 'jam_selesai')) {
                $table->dropColumn('jam_selesai');
            }
            if (Schema::hasColumn('antri_struk', 'admin_harga_total')) {
                $table->dropColumn('admin_harga_total');
            }
            if (Schema::hasColumn('antri_struk', 'admin_harga_rincian')) {
                $table->dropColumn('admin_harga_rincian');
            }
            if (Schema::hasColumn('antri_struk', 'user_price_confirmed_at')) {
                $table->dropColumn('user_price_confirmed_at');
            }
            if (Schema::hasColumn('antri_struk', 'bukti_struk')) {
                $table->dropColumn('bukti_struk');
            }
        });
    }

    public function down(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            // Recreate dropped columns (types are inferred; adjust if your schema differs)
            if (!Schema::hasColumn('antri_struk', 'jam_booking')) {
                $table->date('jam_booking')->nullable()->after('menginap');
            }
            if (!Schema::hasColumn('antri_struk', 'jam_selesai')) {
                $table->date('jam_selesai')->nullable()->after('jam_booking');
            }
            if (!Schema::hasColumn('antri_struk', 'admin_harga_total')) {
                $table->decimal('admin_harga_total', 15, 2)->nullable()->after('harga_keseluruhan');
            }
            if (!Schema::hasColumn('antri_struk', 'admin_harga_rincian')) {
                $table->json('admin_harga_rincian')->nullable()->after('admin_harga_total');
            }
            if (!Schema::hasColumn('antri_struk', 'user_price_confirmed_at')) {
                $table->timestamp('user_price_confirmed_at')->nullable()->after('price_status');
            }
            if (!Schema::hasColumn('antri_struk', 'bukti_struk')) {
                $table->string('bukti_struk')->nullable()->after('user_price_confirmed_at');
            }
        });
    }
};