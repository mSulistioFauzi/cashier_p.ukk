<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.admin.index');
    }
    public function e_dashboard()
    {
        return view('dashboard.petugas.index');
    }
    public function product()
    {
        return view('produk.petugas.index');
    }
    public function pembelian()
    {
        return view('pembelian.admin.index');
    }
    public function user()
    {
        return view('user');
    }
}
