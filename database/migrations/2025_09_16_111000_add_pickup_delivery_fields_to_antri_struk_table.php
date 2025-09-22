<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            $table->boolean('pengambilan')->default(false)->after('catatan');
            $table->boolean('pengiriman')->default(false)->after('pengambilan');
            $table->text('alamat_pengambilan')->nullable()->after('pengiriman');
            $table->text('alamat_pengiriman')->nullable()->after('alamat_pengambilan');
        });
    }

    public function down(): void
    {
        Schema::table('antri_struk', function (Blueprint $table) {
            $table->dropColumn(['pengambilan', 'pengiriman', 'alamat_pengambilan', 'alamat_pengiriman']);
        });
    }
};
