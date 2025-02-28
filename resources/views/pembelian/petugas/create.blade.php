@extends('main')

@section('title', 'penjualan')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($produks as $item)
        <div class="col-md-4 mb-4">
            <div class="card text-center p-3 shadow-sm">
                <img src="{{ asset('storage/' . $item->img) }}" class="img-thumbnail" alt="{{ $item->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="text-muted">Stok: <span id="stock-{{ $item->id }}">{{ $item->stock }}</span></p>
                    <p class="fw-bold">Rp. <span id="price-{{ $item->id }}">{{ number_format($item->price, 0, ',', '.') }}</span></p>

                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-secondary btn-sm" data-id="{{ $item->id }}" onclick="decrementFunction(this)">-</button>
                        <span class="mx-2 jumlah" id="jumlah-{{ $item->id }}">0</span>
                        <button data-id="{{ $item->id }}" class="btn btn-outline-secondary btn-sm" onclick="incrementFunction(this)">+</button>
                    </div>

                    <p class="mt-2">Sub Total <strong>Rp. <span id="subtotal-{{ $item->id }}">0</span></strong></p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-center">
            <form action="{{ route('sale.post') }}" method="post">
                @csrf
                <input type="hidden" name="products" id="productsInput">
                <button type="submit" class="btn btn-primary">Selanjutnya</button>
            </form>
        </div>
    </div>
</div>

<script>
    function incrementFunction(element) {
        const id = element.getAttribute('data-id');
        const jumlahObject = document.getElementById('jumlah-' + id);
        const stockObject = document.getElementById('stock-' + id);
        const subtotalObject = document.getElementById('subtotal-' + id);
        const priceObject = document.getElementById('price-' + id);

        if (jumlahObject && stockObject) {
            let jumlah = parseInt(jumlahObject.textContent) || 0;
            let stock = parseInt(stockObject.textContent) || 0;
            let price = parseInt(priceObject.textContent.replace(/\D/g, '')) || 0;

            if (jumlah < stock) {
                jumlah += 1;
                jumlahObject.textContent = jumlah;
                subtotalObject.textContent = new Intl.NumberFormat('id-ID').format(jumlah * price);
                updateCart(); // Update cart setiap kali jumlah berubah
            } else {
                alert('Stocknya kurang');
            }
        } else {
            console.error("Elemen jumlah atau stock tidak ditemukan untuk ID: " + id);
        }
    }

    function decrementFunction(element) {
        const id = element.getAttribute('data-id');
        const jumlahObject = document.getElementById('jumlah-' + id);
        const subtotalObject = document.getElementById('subtotal-' + id);
        const priceObject = document.getElementById('price-' + id);

        if (jumlahObject) {
            let jumlah = parseInt(jumlahObject.textContent) || 0;
            let price = parseInt(priceObject.textContent.replace(/\D/g, '')) || 0;

            if (jumlah > 0) {
                jumlah -= 1;
                jumlahObject.textContent = jumlah;
                subtotalObject.textContent = new Intl.NumberFormat('id-ID').format(jumlah * price);
                updateCart(); // Update cart setiap kali jumlah berubah
            } else {
                alert('Tidak bisa dikurangi');
            }
        } else {
            console.error("Elemen jumlah atau stock tidak ditemukan untuk ID: " + id);
        }
    }

    function updateCart() {
        let selectedProducts = [];

        document.querySelectorAll(".jumlah").forEach(element => {
            let id = element.id.split("-")[1];
            let jumlah = parseInt(element.textContent) || 0;
            let price = parseInt(document.getElementById("price-" + id).textContent.replace(/\D/g, '')) || 0;
            let name = document.querySelector(`#jumlah-${id}`).closest('.card-body').querySelector('.card-title').textContent;

            if (jumlah > 0) {
                selectedProducts.push({
                    id: id,
                    name: name,
                    jumlah: jumlah,
                    price: price,
                    subtotal: jumlah * price
                });
            }
        });

        // Update input hidden dalam form
        document.getElementById("productsInput").value = JSON.stringify(selectedProducts);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", function (event) {
            updateCart(); // Pastikan produk terbaru tersimpan di hidden input sebelum form dikirim
        });
    });
</script>
@endsection
