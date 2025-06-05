<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $fillable = [
        'tanggal',
        'kode_transaksi',
        'kode_barang',
        'nama_barang',
        'kategori',
        'jumlah_stok',
        'satuan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
