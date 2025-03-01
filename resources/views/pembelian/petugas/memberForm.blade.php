@extends('main')

@section('title', 'Input Nama Member')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sale.storeMember') }}" method="post">
                    @csrf
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="table table-bordered">
                                <table>
                                    <tbody>
                                        <tr class="tabletitle">
                                            <td class="item">Nama Produk</td>
                                            <td class="item">QTY</td>
                                            <td class="item">Harga</td>
                                            <td class="item">Sub Total</td>
                                        </tr>
                                        @foreach ($products as $item)
                                        <tr class="service">
                                            <td class="tableitem">{{ $item['name'] ?? 'Tidak ada nama' }}</td>
                                            <td class="tableitem">{{ $item['quantity']?? 0 }}</td>
                                            <td class="tableitem">{{ $item['price']?? 0 }}</td>
                                            <td class="tableitem">{{ $item['subtotal']?? 0 }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="tabletitle">
                                            <td></td>
                                            <td></td>
                                            <td><h4>Total</h4></td>
                                            <td><h4>{{ $post['total_price'] }}</h4></td>
                                        </tr>
                                        <tr class="tabletitle">
                                            <td></td>
                                            <td></td>
                                            <td><h4>Total Bayar</h4></td>
                                            <td><h4>{{ $post['total_pay'] }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <label for="member_name" class="form-label">Nama Member</label>
                                    <input type="text" class="form-control" id="member_name" name="name" value="{{ $customer->name ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="poin" class="form-label">Poin</label>
                                    <input type="text" class="form-control" id="poin" name="poin" value="{{ $customer->poin }}" disabled>
                                </div>
                                <div class="form-check ms-4">
                                    <input type="checkbox" class="form-check-input" value="Ya" id="check2" name="check_poin">
                                    <label for="check2" class="form-check-label">Gunakan Poin</label>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row text-end">
                                <div class="col-md-12">
                                    <input type="hidden" name="no_hp" value="{{ $post['no_hp'] ?? '' }}">
                                    <input type="hidden" name="total_price" value="{{ $post['total_price'] ?? 0 }}">
                                    <input type="hidden" name="total_pay" value="{{ $post['total_pay'] ?? 0 }}">
                                    <input type="hidden" name="products" value="{{ json_encode($products) }}">
                                    <button type="submit" class="btn btn-primary">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
