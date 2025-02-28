@extends('main')

@section('title', 'Penjualan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(!empty($products))
                        <form action="{{ route('sale.store') }}" method="post">
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
                                    <h2>Produk yang dipilih</h2>
                                    <table style="width: 100%;">       
                                        <thead></thead>
                                        <tbody>
                                            @foreach($products as $item)
                                            <tr>
                                                <td>{{ $item['name'] }}
                                                    <br>
                                                    <small>Rp. {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['jumlah'] }}</small>
                                                </td>
                                                <td>
                                                   <b>Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}</b> 
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td style="padding-top: 20px; font-size: 20px;">
                                                    <b>Total</b>
                                                </td>
                                                <td style="padding-top: 20px; font-size: 20px;">
                                                    <b>Rp. {{ number_format(array_sum(array_column($products, 'subtotal')), 0, ',', '.') }}</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="total" value="{{ array_sum(array_column($products, 'subtotal')) }}">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="member" class="form-label">Member Status</label>
                                            <small class="text-danger">dapat juga membuat member</small>
                                            <select name="member" id="member" class="form-select" onchange="memberDetect()">
                                                <option value="Bukan Member" selected>Bukan Member</option>
                                                <option value="Member">Member</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="member-wrap">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                 <label for="no_hp" class="form-label col-md-12">No. HP <small id="error-hp" class="text-danger">(daftar/gunakan member)</small></label>
                                                 <input type="number" name="no_hp" id="no_hp" class="form-control form-control-line col-md-12" onkeypress="if(this.value.length==13) return false;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="total_pay" class="form-label">Total Bayar</label>
                                            <input type="text" name="total_pay" id="total_pay" class="form-control" oninput="formatRupiah(this); checkTotalPay()">
                                            <small id="error-message" class="text-danger d-none">Jumlah bayar kurang.</small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="total_price" id="total_price" value="{{ array_sum(array_column($products, 'subtotal')) }}">
                                    <input type="hidden" name="products" id="productsInput" value="{{ json_encode($products) }}">
                                    <div class="row text-end">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" id="submit-button" disabled>Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <p class="text-danger">Tidak ada produk yang dipilih.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            memberDetect();
        });

        function memberDetect() {
            const memberSelect = document.getElementById('member');
            const memberWrap = document.getElementById('member-wrap');
            const noHpInput = document.getElementById('no_hp');

            if (memberSelect.value === 'Member') {
                memberWrap.classList.remove('d-none');
                noHpInput.setAttribute('required', 'required');
            } else {
                memberWrap.classList.add('d-none');
                noHpInput.removeAttribute('required');
            }
        }
    
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            let formattedValue = value ? 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
            input.value = formattedValue;
        }

        function checkTotalPay() {
            const totalPayInput = document.getElementById('total_pay');
            const totalValue = parseInt(document.getElementById('total').value, 10);
            const submitButton = document.getElementById('submit-button');
            const errorMessage = document.getElementById('error-message');

            const totalPayValue = parseInt(totalPayInput.value.replace(/[^0-9]/g, ''), 10) || 0;

            if (totalPayValue < totalValue) {
                submitButton.disabled = true;
                errorMessage.classList.remove('d-none');
            } else {
                submitButton.disabled = false;
                errorMessage.classList.add('d-none');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            form.addEventListener("submit", function(event) {
                const totalPayInput = document.getElementById("total_pay");
                totalPayInput.value = totalPayInput.value.replace(/[^0-9]/g, ''); // Hapus Rp dan titik
            });
        });

        document.querySelector("form").addEventListener("submit", function(event) {
        const memberSelect = document.getElementById("member").value;
        const noHpInput = document.getElementById("no_hp").value;

        if (memberSelect === "Member" && noHpInput) {
            event.preventDefault();
            window.location.href = `/sale/member-form?no_hp=${noHpInput}&total_price=${document.getElementById("total_price").value}&total_pay=${document.getElementById("total_pay").value}&products=${encodeURIComponent(document.getElementById("productsInput").value)}`;
        }
    });
    </script>
@endsection
