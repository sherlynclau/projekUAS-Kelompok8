<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::all();
        return view('barangmasuk.index', compact('barangMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jika ingin menampilkan daftar barang di form create, bisa tambahkan:
        // $barangs = Barang::all();
        // return view('barangmasuk.create', compact('barangMasuk', 'barangs'));
        $barangMasuk = BarangMasuk::all();
        return view('barangmasuk.create', compact('barangMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|unique:barang_masuk,kode_transaksi',
            'kode_barang' => 'required|exists:barang,kode_barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah_stok' => 'required|integer|min:1',
            'satuan' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Cari barang berdasarkan kode_barang
            $barang = Barang::where('kode_barang', $input['kode_barang'])->first();

            if (!$barang) {
                DB::rollBack();
                return redirect()->back()->withErrors(['kode_barang' => 'Barang dengan kode barang ini tidak ditemukan.'])->withInput();
            }

            // Tambah stok barang
            $barang->increment('jumlah_stok', $input['jumlah_stok']);

            // Simpan data barang masuk
            BarangMasuk::create($input);

            DB::commit();
            return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan dan stok diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal mencatat barang masuk dan memperbarui stok: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mencatat barang masuk. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($barangMasuk)
    {
        $barangMasuk = BarangMasuk::findOrFail($barangMasuk);
        return view('barangmasuk.show', compact('barangMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($barangMasuk)
    {
        $barangMasuk = BarangMasuk::findOrFail($barangMasuk);
        return view('barangmasuk.edit', compact('barangMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $barangMasuk)
    {
        $barangMasuk = BarangMasuk::findOrFail($barangMasuk);
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required|unique:barang_masuk,kode_transaksi,' . $barangMasuk->id,
            'kode_barang' => 'required|exists:barang,kode_barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah_stok' => 'required|integer',
            'satuan' => 'required',
        ]);
        $barangMasuk->update($input);
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        // Jika ingin mengurangi stok barang saat barang masuk dihapus, tambahkan logika di sini.
        $barangMasuk->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
