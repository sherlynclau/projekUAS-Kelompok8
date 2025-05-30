@extends('layout.main')
@section('title', 'Daftar Barang')

@section('content')
<p>Halaman ini untuk melihat daftar barang</p>
<div class="container">
    <!-- Search Box -->
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="🔍 Search">
    </div>

    <!-- Daftar Barang -->
    <div class="row">
        @foreach ($barang as $item)
        <div class="col-md-3 mb-4">
            <a href="{{ route('barang.show', $item->id) }}" style="text-decoration: none; color: inherit;">
                <div class="card h-100">
                    <img src="images/{{ $item->foto }}" width="80px" class="card-img-top" style="height: 200px; object-fit: contain;">
                    <div class="card-body">
                        <h6>{{ $item->nama_barang }}</h6>
                        <p class="mb-1">Rp {{ number_format($item->harga, 0, ',', '.') }},-</p>
                        <small>Jumlah Stok: {{ $item->jumlah_stok }}</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
