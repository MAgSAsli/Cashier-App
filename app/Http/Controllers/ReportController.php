<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
        $endDate   = $request->end_date ?? now()->toDateString();

        $transactions = Transaction::with('user', 'details.product')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->latest()
            ->get();

        $totalRevenue = $transactions->sum('total_amount');

        return view('reports.index', compact('transactions', 'totalRevenue', 'startDate', 'endDate'));
    }
}
