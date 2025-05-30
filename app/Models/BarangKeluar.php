<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = [
        'tanggal',
        'kode_transaksi',
        'kode_barang',
        'nama_barang',
        'jumlah',
        'satuan',
        'penerima',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
