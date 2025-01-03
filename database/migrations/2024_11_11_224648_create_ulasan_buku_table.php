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
        Schema::create('ulasan_buku', function (Blueprint $table) {
            $table->id('ulasanId');
            $table->unsignedBigInteger('id_user')->required();
            $table->unsignedBigInteger('bukuId')->required();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bukuId')->references('bukuId')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->text('ulasan')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_buku');
    }
};
