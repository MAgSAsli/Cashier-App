<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');
        $lowStock = Product::where('stock', '<', 10)->count();

        return view('dashboard', compact('totalProducts', 'totalTransactions', 'totalRevenue', 'lowStock'));
    }
}
