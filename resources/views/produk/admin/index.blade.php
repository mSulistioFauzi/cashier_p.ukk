@extends('main')

@section('title', 'Produk')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::get('success'))
                    <div class="alert alert-success"> {{ Session::get('success') }}</div>
                    @endif
                    @if (Session::get('deleted'))
                        <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
                    @endif
                    @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary" href="{{ route('product.create') }}">Tambah Produk</a>
                    </div>
                    @foreach ($product as $item)
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('product.updatestock', $item->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Produk:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="name" value="{{ $item->name }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok <span style="color:red">*</span></label>
                                        <input type="text" name="stock" id="stok" class="form-control" value="{{ $item->stock }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>             
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"></th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><img src="{{ asset('storage/' . $item->img) }}" width="100" alt="{{ $item->name }}"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->stock }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('product.edit', $item['id']) }}" class="btn btn-warning me-3">Edit</a>
                                            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">update stok</button>
                                            {{-- <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-info me-3">update stok</a> --}}
                                            <form action="{{ route('product.delete', $item['id']) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
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