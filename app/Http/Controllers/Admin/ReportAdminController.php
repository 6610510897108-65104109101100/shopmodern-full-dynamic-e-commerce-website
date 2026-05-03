<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class ReportAdminController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', Carbon::now()->toDateString());

        // Revenue summary
        $summary = Order::query()
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->select(
                DB::raw('SUM(total_cents) as total_revenue'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('AVG(total_cents) as avg_order_value')
            )
            ->first();

        // Daily revenue for chart
        $dailyRevenue = Order::query()
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_cents) / 100 as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent payments
        $recentPayments = Order::query()
            ->where('payment_status', 'paid')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact('summary', 'dailyRevenue', 'recentPayments', 'startDate', 'endDate'));
    }
}
