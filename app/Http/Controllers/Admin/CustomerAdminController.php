<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

final class CustomerAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q', ''));

        $customers = User::query()
            ->where('is_admin', false)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->withCount('orders')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'q'));
    }

    public function show(User $user)
    {
        // কেন: শুধু কাস্টমার প্রোফাইল দেখাবো, এডমিন নয়
        if ($user->is_admin) {
            return redirect()->route('admin.customers.index');
        }

        $user->load(['orders' => function($q) {
            $q->latest();
        }]);

        return view('admin.customers.show', compact('user'));
    }

    public function toggleBlock(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot block an admin');
        }

        $user->update([
            'is_blocked' => !$user->is_blocked
        ]);

        $status = $user->is_blocked ? 'blocked' : 'allowed';
        return back()->with('success', "Customer has been {$status}");
    }
}
