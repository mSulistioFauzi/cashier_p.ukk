@extends('main')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::User()->role == 'admin')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Ini Halaman Dashboard</h3>
                        <div class="row">
                            <div class="col-8">
                                <canvas id="myChart" width="368" height="184" style="display: block; box-sizing: border-box; height: 184px; width: 368px;"></canvas>
                            </div>
                            <div class="col-4">
                                <canvas id="myChart2" width="170" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 170px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                console.log(["08 February 2025","09 February 2025","10 February 2025","11 February 2025","12 February 2025","13 February 2025","14 February 2025","15 February 2025","16 February 2025","17 February 2025","18 February 2025","19 February 2025","20 February 2025","21 February 2025","22 February 2025","23 February 2025","24 February 2025","25 February 2025","26 February 2025"]);
        console.log([1,15,71,35,10,31,63,1,4,3,16,13,21,14,4,7,53,29,15]);
        console.log(["TV","mesin rumput","HP","gizi seimbang","tws","LMS - Jagoscript","Botol Minum","Buku","niki","Lockheed Skunk F-22 Raptor","Helix","Mesin rumput s8000","oreo","Nutri Sari Dingin","alat solat","Elang Laut","apa we","Mesin Pencari Jodoh","Cokelat","mengheningkan cipta","Botol Minum","Vinyl ABB","dimsum, dibeli ya","mochi","Sigit Putra Pratama","daging segar","Pak Razil","anjing peliharaan","coklat saset edit","TestingNull","azril","es krim","Laravel 12"]);
        console.log([16,39,16,2,20,10,4,17,132,9,16,14,3,2,48,22,6,11,2,1,15,3,3,6,10,22,3,22,2,3,15,2,1]);
        const ctx = document.getElementById('myChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar', // Jenis grafik
            data: {
                labels: ["08 February 2025","09 February 2025","10 February 2025","11 February 2025","12 February 2025","13 February 2025","14 February 2025","15 February 2025","16 February 2025","17 February 2025","18 February 2025","19 February 2025","20 February 2025","21 February 2025","22 February 2025","23 February 2025","24 February 2025","25 February 2025","26 February 2025"], // Menggunakan data dari controller
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: [1,15,71,35,10,31,63,1,4,3,16,13,21,14,4,7,53,29,15], // Menggunakan data dari controller
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myPieChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["TV","mesin rumput","HP","gizi seimbang","tws","LMS - Jagoscript","Botol Minum","Buku","niki","Lockheed Skunk F-22 Raptor","Helix","Mesin rumput s8000","oreo","Nutri Sari Dingin","alat solat","Elang Laut","apa we","Mesin Pencari Jodoh","Cokelat","mengheningkan cipta","Botol Minum","Vinyl ABB","dimsum, dibeli ya","mochi","Sigit Putra Pratama","daging segar","Pak Razil","anjing peliharaan","coklat saset edit","TestingNull","azril","es krim","Laravel 12"],
                datasets: [{
                    label: 'Persentase Penjualan Produk',
                    data: [16,39,16,2,20,10,4,17,132,9,16,14,3,2,48,22,6,11,2,1,15,3,3,6,10,22,3,22,2,3,15,2,1],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Persentase Penjualan Produk'
                    }
                }
            }
        });
            });
        </script>
    @endif
    @if (Auth::User()->role == 'employee')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Selamat Datang, Petugas</h3>
                            <div class="card w-100">
                                <div class="card-header text-center bg-muted">
                                    Total Penjualan Hari Ini
                                </div>
                                <div class="card-body text-center">
                                    <h3>{{ $totalSale }}</h3>
                                    Jumlah total penjualan yang terjadi hari ini.
                                </div>
                                <div class="card-footer text-center text-muted">
                                    Terakhir diperbarui: {{ $lastUpdated }}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection