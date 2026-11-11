<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruang_sidangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruang');
            $table->string('gedung');
            $table->unsignedInteger('kapasitas');
            $table->json('fasilitas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruang_sidangs');
    }
};
