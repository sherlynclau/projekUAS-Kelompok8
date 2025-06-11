@extends('layout.main')
@section('title', 'Daftar Barang')

@section('content')
<p>Halaman ini untuk melihat daftar barang</p>
<div class="container">
    <!-- Search Box -->
    <div class="mb-4">
        <form method="GET" action="{{ route('barang.index') }}">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control" placeholder="Masukkan Nama Barang Yang Ingin Dicari" value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <!-- Daftar Barang -->
    <div class="row">
        @if($barang->count() > 0)
            @foreach ($barang as $item)
            <div class="col-md-3 mb-4">
                <a href="{{ route('barang.show', $item->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="card h-100">
                        <div class="d-flex justify-content-center align-items-center pt-3" style="height: 200px;">
                            <img src="images/{{ $item->foto }}" width="80px" class="card-img-top" style="object-fit: contain; max-height: 180px;">
                        </div>
                        <div class="card-body">
                            <p class="fw-bold fs-6 mb-1">{{ $item->nama_barang }} </p>
                            <p class="fs-6 mb-1">Rp {{ number_format($item->harga, 0, ',', '.') }},- </p>
                            <p class="fs-6">Jumlah Stok: {{ $item->jumlah_stok }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <p class="mt-4">Barang tidak ditemukan.</p>
            </div>
        @endif
    </div>
</div>
@endsection
