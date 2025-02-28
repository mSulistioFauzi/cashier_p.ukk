@extends('main')

@section('title', 'Pembayaran')

@section('content')
<div class="container">
    <div class="row bg-light px-3 py-4 gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card p-4">
                <div class="card-body p-0">
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="custom-actions-btns mb-5">
                                        <a href="http://45.64.100.26:88/ukk-kasir/public/sale/detail-print/print/362" class="btn btn-primary">
                                            <i class="icon-download"></i> Unduh
                                        </a>
                                        <a href="http://45.64.100.26:88/ukk-kasir/public/sale" class="btn btn-secondary">
                                            <i class="icon-printer"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                                                        </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                    <div class="invoice-details">
                                        <div class="invoice-num">
                                            <div>Invoice - #362</div>
                                            <div>24 February 2025</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                        <div class="invoice-body">
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table custom-table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Quantity</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                                        <tr class="service">
                                                        <td class="tableitem">
                                                            <p class="itemtext">coklat saset</p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">Rp.
                                                                43.000.000
                                                            </p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">1</p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">Rp.
                                                                43.000.000
                                                            </p>
                                                        </td>
                                                    </tr>
                                                                                                        <tr class="service">
                                                        <td class="tableitem">
                                                            <p class="itemtext">es krim</p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">Rp.
                                                                100.000
                                                            </p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">1</p>
                                                        </td>
                                                        <td class="tableitem">
                                                            <p class="itemtext">Rp.
                                                                100.000
                                                            </p>
                                                        </td>
                                                    </tr>
                                                                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small>POIN DIGUNAKAN</small>
                                        <span class="text-inverse">0</span>
                                    </div>
                                    <div class="sub-price">
                                        <small>KASIR</small>
                                        <span class="text-inverse">Petugas</span>
                                    </div>
                                    <div class="sub-price">
                                        <small>KEMBALIAN</small>
                                        <span class="text-inverse">Rp. 6.900.000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>TOTAL</small>
                                <span class="f-w-600" style="text-decoration: none;">Rp. 43.100.000</span>
                                                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection