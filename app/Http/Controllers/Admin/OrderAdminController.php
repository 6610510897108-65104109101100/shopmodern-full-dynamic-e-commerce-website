<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

final class OrderAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $status = (string) $request->get('status', '');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $orders = Order::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('order_number', 'like', "%{$q}%")
                      ->orWhere('customer_name', 'like', "%{$q}%")
                      ->orWhere('customer_email', 'like', "%{$q}%");
                });
            })
            ->when($status !== '', fn($query) => $query->where('status', $status))
            ->when($startDate, fn($query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn($query) => $query->whereDate('created_at', '<=', $endDate))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'q', 'status', 'startDate', 'endDate'));
    }

    public function invoice(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.invoice', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['sometimes', 'required', 'in:pending,processing,shipped,delivered,cancelled'],
            'payment_status' => ['sometimes', 'required', 'in:pending,paid,failed'],
        ]);

        $order->update($data);

        return back()->with('success', 'Order updated successfully');
    }
}