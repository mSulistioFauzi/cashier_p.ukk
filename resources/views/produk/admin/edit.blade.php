@extends('main')

@section('title', 'Produk')

@section('content') 
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Produk <span style="color:red">*</span></label>
                        <input type="text" name="namaproduk" id="nama" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gambar" class="form-label">Gambar Produk <span style="color:red">*</span></label>
                        <input type="file" name="gambarproduk" id="gambar" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga" class="form-label">Harga <span style="color:red">*</span></label>
                        <input type="text" name="harga" id="harga" class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stok" class="form-label">Stok <span style="color:red">*</span></label>
                        <input type="text" name="stok" id="stok" class="form-control" value="{{ $product->stock }}">
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection