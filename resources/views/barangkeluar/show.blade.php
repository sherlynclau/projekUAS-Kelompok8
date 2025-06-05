@extends('layout.main')
@section('title', 'Barang Keluar')

@section('content')

     <!--begin::Row-->
     <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Barang Keluar</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-tool"
                  data-lte-toggle="card-collapse"
                  title="Collapse"
                >
                  <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                  <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
                <button
                  type="button"
                  class="btn btn-tool"
                  data-lte-toggle="card-remove"
                  title="Remove"
                >
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>    
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>   
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Penerima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $barangKeluar->tanggal }}</td>
                            <td>{{ $barangKeluar->kode_transaksi }}</td>
                            <td>{{ $barangKeluar->kode_barang }}</td>
                            <td>{{ $barangKeluar->nama_barang }}</td>
                            <td>{{ $barangKeluar->jumlah }}</td>
                            <td>{{ $barangKeluar->satuan }}</td>
                            <td>{{ $barangKeluar->penerima }}</td>
                            <td>
                                <a href="{{ route('barangkeluar.edit', $barangKeluar->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('barangkeluar.destroy', $barangKeluar->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>    
@endsection