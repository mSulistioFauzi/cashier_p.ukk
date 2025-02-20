<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index() {
        return view('pembelian.petugas.index');
    }

    public function create() {
        $produks = Product::all();
        return view('pembelian.petugas.create', compact('produks'));
    }
}
