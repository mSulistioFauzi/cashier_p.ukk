@extends('main')

@section('title', 'Pembelian')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
              <button class="btn btn-primary">Export Penjualan (.xlsx)</button>
              <a href="{{ route('sale.create') }}" class="btn btn-primary">Tambah Penjualan</a>
            </div>
            <div class="table-responsive">
              <table id="myTable" class="display">
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
                    @foreach ($sales as $item)    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->customer ? $item->customer->name : 'NON-MEMBER' }}</td>
                        <td>{{ $item->sale_date }}</td>
                        <td>{{ $item->total_pay }}</td>
                        <td>{{ $item->user ? $item->user->name : '-' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Lihat</button>
                            <button class="btn btn-primary btn-sm">Unduh Bukti</button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection