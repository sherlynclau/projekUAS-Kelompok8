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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('harga')->nullable();
            $table->string('kategori')->nullable();
            $table->string('satuan')->nullable();
            $table->string('lokasi_penyimpanan')->nullable();
            $table->integer('jumlah_stok')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
