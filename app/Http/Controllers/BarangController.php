<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barang = $query->get();

        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        return view('barang.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'lokasi_penyimpanan' => 'required',
            'deskripsi' => 'nullable|string|max:500',
            'harga' => 'required|numeric|min:0',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            // $file = $request->file('foto');
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('images'), $filename);
            // $input['foto'] = $filename;

            // $file = $request->file('foto');
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('images'), $filename); // simpan foto ke folder public/images
            // $input['foto'] = $filename; // simpan nama file baru ke $input

            try {
                $file = $request->file('foto');
                $response = Http::asMultipart()->post(
                    'https://api.cloudinary.com/v1_1/' . env('CLOUDINARY_CLOUD_NAME') . '/image/upload',
                    [
                        [
                            'name'     => 'file',
                            'contents' => fopen($file->getRealPath(), 'r'),
                            'filename' => $file->getClientOriginalName(),
                        ],
                        [
                            'name'     => 'upload_preset',
                            'contents' => env('CLOUDINARY_UPLOAD_PRESET'),
                        ],
                    ]
                );

                $result = $response->json();
                if (isset($result['secure_url'])) {
                    $input['foto'] = $result['secure_url'];
                } else {
                    return back()->withErrors(['foto' => 'Cloudinary upload error: ' . ($result['error']['message'] ?? 'Unknown error')]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['foto' => 'Cloudinary error: ' . $e->getMessage()]);
            }
        }

        Barang::create($input);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($barang)
    {
        // dd($barang);
        $barang = Barang::findOrFail($barang);
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        // Tidak perlu findOrFail lagi
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $input = $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'lokasi_penyimpanan' => 'required',
            'deskripsi' => 'nullable|string|max:500',
            'harga' => 'required|numeric|min:0',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['foto'] = $filename;
        }

        $barang->update($input);

        return redirect()->route('barang.show', $barang->id)->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Tidak perlu findOrFail lagi
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}