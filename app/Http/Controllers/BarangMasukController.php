<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

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
            'kode_transaksi' => 'required',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
        ]);
        BarangMasuk::create($input);
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
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
    public function edit(BarangMasuk $barangMasuk)
    {
        return view('barangMasuk.edit', compact('barangMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $barangMasuk = BarangMasuk::findOrFail($barangMasuk->id);
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
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
        $barangMasuk = BarangMasuk::findOrFail($barangMasuk->id);
        $barangMasuk->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
