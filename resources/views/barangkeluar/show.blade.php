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
              <table class="table table-bordered table-striped">
                  <tr>
                      <th>Tanggal</th>
                      <td>{{ $barangKeluar->tanggal }}</td>
                  </tr>
                  <tr>
                      <th>Kode Transaksi</th>
                      <td>{{ $barangKeluar->kode_transaksi }}</td>
                  </tr>
                  <tr>
                      <th>Kode Barang</th>
                      <td>{{ $barangKeluar->kode_barang }}</td>
                  </tr>
                  <tr>
                      <th>Nama Barang</th>
                      <td>{{ $barangKeluar->nama_barang }}</td>
                  </tr>
                  <tr>
                      <th>Jumlah Stok</th>
                      <td>{{ $barangKeluar->jumlah_stok }}</td>
                  </tr>
                  <tr>
                      <th>Satuan</th>
                      <td>{{ $barangKeluar->satuan }}</td>
                  </tr>
                  <tr>
                      <th>Penerima</th>
                      <td>{{ $barangKeluar->penerima }}</td>
                  </tr>
              </table>
            </div>
        </div>
    </div>
    </div>    
@endsection