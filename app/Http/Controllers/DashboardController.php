<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSale = Sale::whereDate('created_at', Carbon::today())->count();
    
        // Format waktu saat ini
        $lastUpdated = Carbon::now()->format('d M Y H:i');
 
        return view('dashboard', compact('totalSale', 'lastUpdated'));
    }
}
