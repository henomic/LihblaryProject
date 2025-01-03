<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_relasi', function (Blueprint $table) {
            $table->id('kategoriBukuId');
            $table->unsignedBigInteger('bukuId')->required();
            $table->foreign('bukuId')->references('bukuId')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_kategori')->required();
            $table->foreign('id_kategori')->references('kategoriId')->on('kategori')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_relasi');
    }
};
