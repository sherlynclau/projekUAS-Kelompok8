@extends('layout.main')
@section('title', 'Barang Keluar')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Edit Barang Keluar</div>
        </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('barangkeluar.update', $barangKeluar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $barangKeluar->tanggal) }}">
                        @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                        <input type="text" class="form-control" name="kode_transaksi" value="{{ old('kode_transaksi', $barangKeluar->kode_transaksi) }}">
                        @error('kode_transaksi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" value="{{ old('kode_barang', $barangKeluar->kode_barang) }}">
                        @error('kode_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang', $barangKeluar->nama_barang) }}">
                        @error('nama_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah_stok" value="{{ old('jumlah_stok', $barangKeluar->jumlah_stok) }}">
                        @error('jumlah_stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" name="satuan">
                            <option value="">-- Pilih Satuan --</option>
                            <option value="pcs" {{ old('satuan', $barangKeluar->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                            <option value="unit" {{ old('satuan', $barangKeluar->satuan) == 'unit' ? 'selected' : '' }}>unit</option>
                            <option value="kotak" {{ old('satuan', $barangKeluar->satuan) == 'kotak' ? 'selected' : '' }}>kotak</option>
                            <option value="lembar" {{ old('satuan', $barangKeluar->satuan) == 'lembar' ? 'selected' : '' }}>lembar</option>
                            <option value="pak" {{ old('satuan', $barangKeluar->satuan) == 'pak' ? 'selected' : '' }}>pak</option>
                            <option value="rim" {{ old('satuan', $barangKeluar->satuan) == 'rim' ? 'selected' : '' }}>rim</option>
                            <option value="dus" {{ old('satuan', $barangKeluar->satuan) == 'dus' ? 'selected' : '' }}>dus</option>
                            <option value="roll" {{ old('satuan', $barangKeluar->satuan) == 'roll' ? 'selected' : '' }}>roll</option>
                            <option value="lusin" {{ old('satuan', $barangKeluar->satuan) == 'lusin' ? 'selected' : '' }}>lusin</option>
                        </select>
                        @error('satuan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penerima" class="form-label">Penerima</label>
                        <input type="text" class="form-control" name="penerima" value="{{ old('penerima', $barangKeluar->penerima) }}">
                        @error('penerima')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Row-->
@endsection