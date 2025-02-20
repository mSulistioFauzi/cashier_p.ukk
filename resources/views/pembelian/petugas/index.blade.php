@extends('main')

@section('title', 'Pembelian')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <button class="btn btn-primary">Export Penjualan (.xlsx)</button>
              <a href="{{ route('sale.create') }}" class="btn btn-primary">Tambah Penjualan</a>
            </div>
            <div class="table-responsive">
              <table id="salesTable" class="table table-striped caption-top">
                <caption>entri</caption>
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Pelanggan</th>
                          <th>Tanggal Penjualan</th>
                          <th>Total Harga</th>
                          <th>Dibuat Oleh</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>1</td>
                          <td>NON-MEMBER</td>
                          <td>2025-02-20</td>
                          <td>Rp. 12.000.000</td>
                          <td>Petugas</td>
                          <td>
                              <button class="btn btn-warning btn-sm">Lihat</button>
                              <button class="btn btn-primary btn-sm">Unduh Bukti</button>
                          </td>
                      </tr>
                  </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection