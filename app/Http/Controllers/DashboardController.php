<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function index()
    {
        $userId = Auth::id();
        $branchId = session('branch_id');

        $orders = Sale::where('user_id', $userId)->latest()->take(5)->get();
        $totalOrders = $orders->count();
        $totalSales = $orders->sum('total_amount');
        $pendingOrders = $orders->where('status', '!=', 'completed')->count();

        return view('dashboard', compact('orders', 'totalOrders', 'totalSales', 'pendingOrders'));
    }
}
