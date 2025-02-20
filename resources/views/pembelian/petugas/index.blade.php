@extends('main')

@section('title', 'Pembelian')

@section('content')
<table class="table caption-top">
    <caption>List of users</caption>
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Pelanggan</th>
        <th scope="col">Tanggal Penjualan</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Dibuat Oleh</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 3; $i++)
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>100.000</td>
            <td>Petugas</td>
            <td class="d-flex justify-content-center">
                <a href="#" class="btn btn-warning me-5">Lihat</a>
                {{-- <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-info me-3">update stok</a> --}}
                <form action="#" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-info ms-5">Hapus</button>
                </form>
            </td>
          </tr>
        @endfor
    </tbody>
  </table>
@endsection