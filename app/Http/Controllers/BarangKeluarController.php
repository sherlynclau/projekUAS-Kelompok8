<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

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
        $barangKeluar = BarangKeluar::all();
        return view('barangkeluar.create', compact('barangKeluar'));
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
            'jumlah' => 'required|integer',
            'satuan' => 'required',
            'penerima' => 'required|string|max:255',
        ]);
        BarangKeluar::create($input);
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        $barangKeluar = BarangKeluar::findOrFail($barangKeluar->id);
        return view('barangkeluar.show', compact('barangKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        // $barangKeluar = BarangKeluar::findOrFail($barangKeluar->id);
        return view('barangkeluar.edit', compact('barangKeluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $barangKeluar)
    {
        
        $input = $request->validate([
            'tanggal' => 'required|date',
            'kode_transaksi' => 'required',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
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
        $barangKeluar->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }
}
