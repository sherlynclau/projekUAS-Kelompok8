@extends('layout.main')
@section('title', 'Edit Barang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Edit Barang</div>
            </div>
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" value="{{ old('foto') ? old ('foto') : $barang->foto }}">
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" value="{{ old('kode_barang') ? old ('kode_barang') : $barang->kode_barang }}">
                        @error('kode_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') ? old ('nama_barang') : $barang->nama_barang }}">
                        @error('nama_barang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" name="kategori" value="{{ old('kategori') ? old ('kategori') : $barang->kategori }}">
                        @error('kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" name="satuan" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="pcs" {{ old('satuan', $barang->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                            <option value="unit" {{ old('satuan', $barang->satuan) == 'unit' ? 'selected' : '' }}>unit</option>
                            <option value="kotak" {{ old('satuan', $barang->satuan) == 'kotak' ? 'selected' : '' }}>kotak</option>
                            <option value="lembar" {{ old('satuan', $barang->satuan) == 'lembar' ? 'selected' : '' }}>lembar</option>
                            <option value="pak" {{ old('satuan', $barang->satuan) == 'pak' ? 'selected' : '' }}>pak</option>
                            <option value="rim" {{ old('satuan', $barang->satuan) == 'rim' ? 'selected' : '' }}>rim</option>
                            <option value="dus" {{ old('satuan', $barang->satuan) == 'dus' ? 'selected' : '' }}>dus</option>
                            <option value="roll" {{ old('satuan', $barang->satuan) == 'roll' ? 'selected' : '' }}>roll</option>
                            <option value="lusin" {{ old('satuan', $barang->satuan) == 'lusin' ? 'selected' : '' }}>lusin</option>
                        </select>
                        @error('satuan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control" name="harga" value="{{ old('harga') ? old ('harga') : $barang->harga  }}" pattern="\d+" title="Masukkan hanya angka">
                            <span class="input-group-text">,-</span>
                        </div>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_penyimpanan" class="form-label">Lokasi Penyimpanan</label>
                        <input type="text" class="form-control" name="lokasi_penyimpanan" value="{{ old('lokasi_penyimpanan') ? old ('lokasi_penyimpanan') : $barang->lokasi_penyimpanan }}">
                        @error('lokasi_penyimpanan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah_stok" value="{{ old('jumlah_stok') ? old ('jumlah_stok') : $barang->jumlah_stok }}">
                        @error('jumlah_stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi') ? old ('deskripsi') : $barang->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
