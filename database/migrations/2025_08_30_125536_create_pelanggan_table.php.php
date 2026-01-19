<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->bigIncrements('id_pelanggan');
                $table->string('nama', 150);
                $table->string('email')->unique()->nullable();
                $table->string('password');
                $table->string('no_wa', 30)->nullable();
                $table->text('alamat')->nullable();
                $table->string('foto_profil')->nullable();
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }
    }
}
