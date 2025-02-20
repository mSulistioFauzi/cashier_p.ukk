@extends('main')

@section('title', 'Produk')

@section('content') 
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama<span style="color:red">*</span></label>
                        <input type="text" name="name" id="bname" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">email<span style="color:red">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">password<span style="color:red">*</span></label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role<span style="color:red">*</span></label>
                        <select class="form-select" name="role" id="role" aria-label="Default select example" required>
                            <option selected disabled hidden>Open this select role</option>
                            <option value="admin">admin</option>
                            <option value="employee">employee</option>
                          </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection