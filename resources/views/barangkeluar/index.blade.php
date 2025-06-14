@extends('layout.main')
@section('title', 'Barang Keluar')

@section('content')
     <!--begin::Row-->
     <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Barang Keluar</h3>
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
                @can('create', App\Models\BarangKeluar::class)
              <a href="{{ route('barangkeluar.create') }}" class="btn btn-primary"> Tambah </a>
              @endcan
                <table class = "table">
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
                        @foreach ($barangKeluar as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->kode_transaksi}}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->jumlah_stok }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->penerima }}</td>
                                <td>
                                    <a href="{{ route('barangkeluar.show', $item->id) }}" class="btn btn-info">Show</a>
                                    @can('update', $item)
                                    <a href="{{ route('barangkeluar.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('delete', $item)
                                    <form action="{{ route('barangkeluar.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>    
@endsection