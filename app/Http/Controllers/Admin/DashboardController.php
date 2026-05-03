<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenueCents = Order::where('status', '!=', 'cancelled')->sum('total_cents');
        $totalCustomers = User::where('is_admin', false)->count(); // Assuming is_admin field
        $totalProducts = Product::count();

        $recentOrders = Order::latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->take(5)->get();

        // Data for chart (last 7 days)
        $salesData = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_cents) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenueCents', 'totalCustomers', 'totalProducts',
            'recentOrders', 'lowStockProducts', 'salesData'
        ));
    }
}
