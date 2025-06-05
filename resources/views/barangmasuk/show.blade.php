@extends('layout.main')
@section('title', 'Barang Masuk')

@section('content')

     <!--begin::Row-->
     <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Barang Masuk</h3>
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
              <div class="card-body">
              <table class="table table-bordered table-striped">
                  <tr>
                      <th>Tanggal</th>
                      <td>{{ $barangMasuk->tanggal }}</td>
                  </tr>
                  <tr>
                      <th>Kode Transaksi</th>
                      <td>{{ $barangMasuk->kode_transaksi }}</td>
                  </tr>
                  <tr>
                      <th>Kode Barang</th>
                      <td>{{ $barangMasuk->kode_barang }}</td>
                  </tr>
                  <tr>
                      <th>Nama Barang</th>
                      <td>{{ $barangMasuk->nama_barang }}</td>
                  </tr>
                  <tr>
                      <th>Kategori</th>
                      <td>{{ $barangMasuk->kategori }}</td>
                  </tr>
                  <tr>
                      <th>Jumlah</th>
                      <td>{{ $barangMasuk->jumlah }}</td>
                  </tr>
                  <tr>
                      <th>Satuan</th>
                      <td>{{ $barangMasuk->satuan }}</td>
                  </tr>
              </table>
          </div>

                </table>
            </div>
        </div>
    </div>
    </div>    
@endsection