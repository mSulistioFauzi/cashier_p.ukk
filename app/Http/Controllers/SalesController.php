<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DetailSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index() {
        $sales = Sale::with(['customer', 'user'])->get();
        
        if (Auth::user()->role == 'admin') {
            return view('pembelian.admin.index');
        } elseif (Auth::User()->role == 'employee') {
            return view('pembelian.petugas.index', compact('sales'));
        }
    }
    
    public function create() {
        $produks = Product::all();
        return view('pembelian.petugas.create', compact('produks'));
    }

    public function post(Request $request) {
        $products = json_decode($request->input('products'), true);
        return view('pembelian.petugas.post', compact('products'));
    }

    // public function store(Request $request)
    // {
    //     // dd($request->all());

    //     $totalPay = str_replace(['Rp.', '.'], '', $request->total_pay);
    //     $request->merge(['total_pay' => $totalPay]);    
    //     // Validasi input
    //     $request->validate([
    //         'total_price' => 'required|numeric|min:1',
    //         'total_pay' => 'required|numeric|min:1',
    //         'member' => 'required',
    //         'no_hp' => 'nullable|numeric|digits_between:10,13', // Pastikan no HP dalam rentang panjang 10-13 digit
    //         'products' => 'required|json', // Pastikan produk dikirim sebagai JSON yang valid
    //     ]);

    //     // Cek apakah pelanggan adalah member
    //     $customer = null;
    //     if ($request->member == "Member" && !empty($request->no_hp)) {
    //         $customer = Customer::firstOrCreate(
    //             ['no_hp' => $request->no_hp],
    //             ['name' => 'Guest', 'poin' => 0]
    //         );
    //     }

    //     // Simpan transaksi utama
    //     $sale = Sale::create([
    //         'sale_date' => now(),
    //         'total_price' => $request->total_price,
    //         'total_pay' => $request->total_pay,
    //         'total_return' => $request->total_pay - $request->total_price,
    //         'customer_id' => $customer ? $customer->id : null,
    //         'user_id' => Auth::id(), // User yang melakukan transaksi
    //         'poin' => 0, // Implementasi poin bisa ditambahkan
    //         'total_poin' => 0
    //     ]);

    //     // Simpan detail transaksi
    //     $products = json_decode($request->input('products'), true);
            
    //     foreach ($products as $product) {
    //         DetailSale::create([
    //             'sale_id' => $sale->id,
    //             'product_id' => $product['id'],
    //             'amount' => $product['jumlah'],
    //             'sub_total' => $product['subtotal']
    //         ]);
    //     }

    //     return redirect()->route('sale.index')->with('success', 'Transaksi berhasil disimpan!');
    // }

    public function store(Request $request)
{
        // Menghapus format mata uang dari total bayar
        $totalPay = str_replace(['Rp.', '.'], '', $request->total_pay);
        $request->merge(['total_pay' => $totalPay]);

        // Validasi input
        $request->validate([
            'total_price' => 'required|numeric|min:1',
            'total_pay' => 'required|numeric|min:1',
            'member' => 'required',
            'no_hp' => 'nullable|numeric|digits_between:10,13',
            'products' => 'required|json',
        ]);

        // Jika user memilih "Member", redirect ke halaman input nama
        if ($request->member == "Member" && !empty($request->no_hp)) {
            return redirect()->route('sale.memberForm', ['no_hp' => $request->no_hp, 'total_price' => $request->total_price, 'total_pay' => $request->total_pay, 'products' => $request->products]);
        }

        // Simpan transaksi jika bukan member
        return $this->processSale($request, null);
    }

    // Fungsi untuk menyimpan transaksi
    private function processSale(Request $request, $customerId)
    {
        // Simpan transaksi utama
        $sale = Sale::create([
            'sale_date' => now(),
            'total_price' => $request->total_price,
            'total_pay' => $request->total_pay,
            'total_return' => $request->total_pay - $request->total_price,
            'customer_id' => $customerId,
            'user_id' => Auth::id(),
            'poin' => 0,
            'total_poin' => 0
        ]);

        // Simpan detail transaksi
        $products = json_decode($request->input('products'), true);
        foreach ($products as $product) {
            DetailSale::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'amount' => $product['jumlah'],
                'sub_total' => $product['subtotal']
            ]);
        }

        return redirect()->route('sale.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    // Fungsi untuk menampilkan form input nama member
    public function memberForm(Request $request)
    {
        return view('sale.memberForm', [
            'no_hp' => $request->no_hp,
            'total_price' => $request->total_price,
            'total_pay' => $request->total_pay,
            'products' => $request->products
        ]);
    }

    // Fungsi untuk menyimpan member dan transaksi
    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'total_price' => 'required|numeric|min:1',
            'total_pay' => 'required|numeric|min:1',
            'products' => 'required|json'
        ]);

        // Simpan atau cari member berdasarkan nomor HP
        $customer = Customer::firstOrCreate(
            ['no_hp' => $request->no_hp],
            ['name' => $request->name, 'poin' => 0]
        );

        // Proses transaksi
        return $this->processSale($request, $customer->id);
    }

    
    public function detailPrint() {
        return view('pembelian.petugas.detail-print');
    }
    
}
