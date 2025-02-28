@extends('main')

@section('title', 'Input Nama Member')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2>Masukkan Nama Member</h2>
                <form action="{{ route('sale.storeMember') }}" method="post">
                    @csrf
                    <input type="hidden" name="no_hp" value="{{ $no_hp }}">
                    <input type="hidden" name="total_price" value="{{ $total_price }}">
                    <input type="hidden" name="total_pay" value="{{ $total_pay }}">
                    <input type="hidden" name="products" value="{{ $products }}">

                    <div class="form-group">
                        <label for="name">Nama Member</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Lanjutkan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
