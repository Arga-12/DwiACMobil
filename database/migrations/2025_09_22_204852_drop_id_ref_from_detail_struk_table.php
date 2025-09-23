<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('detail_struk', 'id_ref')) {
            Schema::table('detail_struk', function (Blueprint $table) {
                $table->dropColumn('id_ref');
            });
        }
    }

    public function down(): void
    {
        Schema::table('detail_struk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ref')->nullable()->after('tipe');
        });
    }
};