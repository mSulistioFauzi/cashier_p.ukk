<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index() 
    {
        $product = Product::all();
        
        if(Auth::user()->role == 'admin'){
            return view('produk.admin.index', compact('product'));
        } elseif (Auth::user()->role == 'employee') {
            return view('produk.petugas.index', compact('product'));
        }
    }

    public function create() 
    {
        $product = new Product();
        return view('produk.admin.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required|min:3|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambarproduk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambarproduk')) {
            $gambarPath = $request->file('gambarproduk')->store('produk_gambar', 'public'); // Menyimpan gambar
        }

        $produk = Product::create([
        'name' => $request->input('namaproduk'),
            'price' => $request->input('harga'),
            'stock' => $request->input('stok'),
            'img' => $gambarPath, // Menyimpan path gambar ke kolom gambarproduk
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Produk berhasil disimpan!');
    }

    public function edit(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        // dd($product->all());
        return view('produk.admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaproduk' => 'required|min:3|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambarproduk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil produk berdasarkan ID
        $produk = Product::findOrFail($id);

        // Simpan gambar jika ada yang diupload
        if ($request->hasFile('gambarproduk')) {
            $gambarPath = $request->file('gambarproduk')->store('produk_gambar', 'public');
            $produk->img = $gambarPath; // Simpan path gambar ke database
        }

        // Update produk dengan data dari request
        $produk->update([
            'name' => $request->input('namaproduk'),
            'price' => $request->input('harga'),
            'stock' => $request->input('stok'),
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Produk berhasil diedit!');
    }

    public function updatedstock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $produk = Product::findOrFail($id);
        $produk->update([
            'stock' => $request->input('stock'),
        ]);

        return redirect()->route('product.index')->with('success', 'stock berhasil diupdate!');
    }

    public function destroy ($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->witH('deleted', 'Berhasil Menghapus Product');
    }
}
