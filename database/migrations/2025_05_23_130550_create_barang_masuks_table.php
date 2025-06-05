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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('kode_transaksi')->unique();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->integer('jumlah_stok'); // histori stok masuk
            $table->string('satuan');
            $table->timestamps();

            // Foreign key ke tabel barang
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
