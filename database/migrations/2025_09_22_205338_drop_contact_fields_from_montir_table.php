<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('montir', function (Blueprint $table) {
            if (Schema::hasColumn('montir', 'no_wa')) {
                $table->dropColumn('no_wa');
            }
            if (Schema::hasColumn('montir', 'facebook')) {
                $table->dropColumn('facebook');
            }
            if (Schema::hasColumn('montir', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('montir', function (Blueprint $table) {
            // Kembalikan kolom jika rollback
            $table->string('no_wa', 30)->nullable()->after('password');
            $table->string('facebook')->nullable()->after('no_wa');
            $table->text('keterangan')->nullable()->after('peran');
        });
    }
};