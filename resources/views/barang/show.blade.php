@extends('layout.main')

@section('title', 'Detail Barang')

@section('content')
<p>Halaman ini untuk menampilkan detail barang</p>
<div class="container mt-4">
    <div class="row">
        <!-- Gambar -->
        <div class="col-md-4">
            <div class="card shadow-sm p-2">
                <img src="{{ asset('images/' . $barang->foto) }}" class="card-img-top img-fluid" style="object-fit: contain; height: 300px;">
            </div>
        </div>

        <!-- Detail -->
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h4 class="mb-4"><strong>{{ $barang->nama_barang }}</strong></h4>
                <table class="table table-borderless mb-3" cellpadding="4" cellspacing="0" style="width: 100%;">
                <tr>
                    <td>Kode Barang</td>
                    <td>: {{$barang->kode_barang }}</td>
                    <td>Harga</td>
                    <td>: Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>: {{ $barang->satuan }}</td>
                    <td>Lokasi Penyimpanan</td>
                    <td>: {{ $barang->lokasi_penyimpanan }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>: {{ $barang->kategori }}</td>
                    <td>Jumlah Stok</td>
                    <td>: {{ $barang->jumlah_stok }}</td>
                </tr>
                <tr>
                    <td>Deskripsi :</td>
                </tr>
                <tr>
                    <td colspan="3">{{ $barang->deskripsi }}</td>
                </tr>
            </table>
            <div class="d-flex gap-2">
                @can('update', $barang)
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
                </a>
                @endcan
                @can('delete', $barang)                
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
                @endcan
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection