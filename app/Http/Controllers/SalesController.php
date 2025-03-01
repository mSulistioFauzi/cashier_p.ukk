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
            // dd('Member'); berhasil mengecek ini adalah member
            return redirect()->route('sale.memberForm', ['no_hp' => $request->no_hp, 'total_price' => $request->total_price, 'total_pay' => $request->total_pay, 'products' => $request->products]);
        } else {
            // Simpan transaksi jika bukan member
            return $this->processSale($request, null);
        }
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
        $post = $request->validate([
            'no_hp' => 'required|numeric|digits_between:10,13',
            'total_price' => 'required|numeric|min:1',
            'total_pay' => 'required|numeric|min:1',
        ]);

        $customer = Customer::where('no_hp', $post['no_hp'])->first();
        $sale = Sale::where('customer_id', $customer->id ?? null)->latest()->first();
        $products = json_decode($request->products, true);
        // dd($products, $request->all());
        return view('pembelian.petugas.memberForm', compact('products', 'post', 'customer', 'sale'));
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
        // dd($request->all());

        // Simpan atau cari member berdasarkan nomor HP
        $customer = Customer::firstOrCreate(
            ['no_hp' => $request->no_hp],
            ['name' => $request->name, 'poin' => 0] // Default poin 0 jika baru daftar
        );
        
        // Tambahkan poin untuk setiap transaksi
        $customer->poin += 100; // Misalnya, dapat 10 poin setiap transaksi
        $customer->save();
        

        // Proses transaksi
        return $this->processSale($request, $customer->id);
    }

    
    public function detailPrint() {
        return view('pembelian.petugas.detail-print');
    }
    
}
