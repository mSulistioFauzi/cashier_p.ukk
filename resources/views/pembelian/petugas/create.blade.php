@extends('main')

@section('title', 'penjualan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @foreach ($produks as $item)
                <div class="card text-center p-3 shadow-sm">
                    <img src="{{ asset('storage/' . $item->img) }}" class="img-thumbnail" width="500" alt="{{ $item->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="text-muted">{{ $item->stock }}</p>
                        <p class="fw-bold">{{ $item->price }}</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-secondary btn-sm">-</button>
                            <span class="mx-2">0</span>
                            <button class="btn btn-outline-secondary btn-sm">+</button>
                        </div>
                        <p class="mt-2">Sub Total <strong>Rp. 0</strong></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection