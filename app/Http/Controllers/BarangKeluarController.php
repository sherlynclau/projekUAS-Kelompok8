<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\Barang; // Ini adalah model Produk kamu, pastikan namanya 'Barang' atau 'Product'
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk logging error

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::all();
        return view('barangkeluar.index', compact('barangKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jika kamu perlu menampilkan daftar barang di form create, kamu bisa ambil di sini
        // $barangs = Barang::all();
        // return view('barangkeluar.create', compact('barangKeluar', 'barangs'));
        $barangKeluar = BarangKeluar::all();
        return view('barangkeluar.create', compact('barangKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|unique:barang_keluar,kode_transaksi', // Pastikan kode transaksi unik
            'kode_barang' => 'required|exists:barang,kode_barang', // Validasi: kode_barang harus ada di tabel 'barangs'
            'nama_barang' => 'required',
            'jumlah_stok' => 'required|integer|min:1', // Jumlah harus bilangan bulat positif
            'satuan' => 'required',
            'penerima' => 'required|string|max:255',
        ]);

        // 2. Mulai transaksi database untuk menjaga konsistensi data
        DB::beginTransaction();

        try {
            // 3. Cari barang berdasarkan kode_barang
            // Asumsi: model Barang mewakili tabel produkmu, dan memiliki kolom 'kode_barang'
            $barang = Barang::where('kode_barang', $input['kode_barang'])->first();

            // 4. Periksa apakah barang ditemukan
            if (!$barang) {
                DB::rollBack(); // Batalkan transaksi jika barang tidak ditemukan
                return redirect()->back()->withErrors(['kode_barang' => 'Barang dengan kode barang ini tidak ditemukan.'])->withInput();
            }

            // 5. Periksa ketersediaan stok
            if ($barang->stock < $input['jumlah_stok']) {
                DB::rollBack(); // Batalkan transaksi jika stok tidak mencukupi
                return redirect()->back()->withErrors(['jumlah_stok' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stock . ' ' . $barang->satuan])->withInput();
            }

            // 6. Kurangi stok barang
            // Menggunakan metode decrement() untuk mengurangi stok secara aman
            $barang->decrement('stock', $input['jumlah_stok']);

            // 7. Simpan data barang keluar
            BarangKeluar::create($input);

            // 8. Commit transaksi jika semua operasi berhasil
            DB::commit();

            return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil ditambahkan dan stok diperbarui.');

        } catch (\Exception $e) {
            // 9. Jika terjadi kesalahan, batalkan semua perubahan dan berikan pesan error
            DB::rollBack();
            Log::error('Gagal mencatat barang keluar dan memperbarui stok: ' . $e->getMessage()); // Catat error untuk debugging
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mencatat barang keluar. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($barangKeluar)
    {
        $barangKeluar = BarangKeluar::findOrFail($barangKeluar);
        return view('barangkeluar.show', compact('barangKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($barangKeluar)
    {
        $barangKeluar = BarangKeluar::findOrFail($barangKeluar);
        return view('barangkeluar.edit', compact('barangKeluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $barangKeluar)
    {
        $barangKeluar = BarangKeluar::findOrFail($barangKeluar);
        // Penting: Jika update juga mempengaruhi stok, logika serupa dengan 'store' perlu diterapkan di sini.
        // Saat ini, update hanya mengubah data barang keluar, tidak stok barang terkait.
        // Jika kamu ingin mengimplementasikan perubahan stok saat update, itu akan lebih kompleks
        // karena perlu menghitung selisih jumlah barang keluar sebelumnya dan yang baru.
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|unique:barang_keluars,kode_transaksi,' . $barangKeluar->id, // Abaikan ID saat validasi unique
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'nama_barang' => 'required',
            'jumlah_stok' => 'required|integer',
            'satuan' => 'required',
            'penerima' => 'required|string|max:255',
        ]);
        $barangKeluar->update($input);
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        // Penting: Saat menghapus catatan barang keluar, kamu mungkin perlu mengembalikan stok barang.
        // Jika ya, tambahkan logika di sini:
        // DB::beginTransaction();
        // try {
        //     $barang = Barang::where('kode_barang', $barangKeluar->kode_barang)->first();
        //     if ($barang) {
        //         $barang->increment('stock', $barangKeluar->jumlah);
        //     }
        //     $barangKeluar->delete();
        //     DB::commit();
        //     return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil dihapus dan stok dikembalikan.');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error('Gagal menghapus barang keluar dan mengembalikan stok: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus barang keluar.');
        // }

        $barangKeluar->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }
}