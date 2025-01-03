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
        Schema::create('pencatatan_stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bukuId');
            $table->foreign('bukuId')->references('bukuId')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah')->required();
        $table->string('status')->required();
            $table->string('keterangan')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_stok');
    }
};
