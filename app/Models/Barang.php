<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'foto',
        'kode_barang',
        'nama_barang',
        'harga',
        'kategori',
        'satuan',
        'lokasi_penyimpanan',
        'jumlah_stok',
        'deskripsi',
    ];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang');
    }

}
