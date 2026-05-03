@extends('layouts.admin')

@section('title', 'Order Management')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Order Management</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-sm italic">Track sales and fulfill customer requests</p>
    </div>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-3">
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">search</span>
            <input name="q" value="{{ $q ?? '' }}" placeholder="Search by name, email, or #ORD..." 
                   class="pl-12 pr-4 py-3 rounded-2xl bg-white dark:bg-slate-900 border-none ring-1 ring-slate-200 dark:ring-slate-800 focus:ring-2 focus:ring-primary transition-all font-bold w-full sm:w-72 shadow-sm text-sm">
        </div>
        
        <div class="flex items-center gap-2 bg-white dark:bg-slate-900 px-4 py-2 rounded-2xl ring-1 ring-slate-200 dark:ring-slate-800 shadow-sm">
            <span class="material-symbols-outlined text-slate-400 text-sm">calendar_today</span>
            <input type="date" name="start_date" value="{{ $startDate }}" class="bg-transparent border-none text-xs font-bold focus:ring-0 p-0 w-28">
            <span class="text-slate-300 font-bold">to</span>
            <input type="date" name="end_date" value="{{ $endDate }}" class="bg-transparent border-none text-xs font-bold focus:ring-0 p-0 w-28">
        </div>
        
        <select name="status" class="py-3 px-5 rounded-2xl bg-white dark:bg-slate-900 border-none ring-1 ring-slate-200 dark:ring-slate-800 focus:ring-2 focus:ring-primary transition-all font-bold shadow-sm text-sm min-w-[120px]">
            <option value="">Status</option>
            <option value="pending" @selected(($status ?? '')==='pending')>Pending</option>
            <option value="processing" @selected(($status ?? '')==='processing')>Processing</option>
            <option value="shipped" @selected(($status ?? '')==='shipped')>Shipped</option>
            <option value="delivered" @selected(($status ?? '')==='delivered')>Delivered</option>
            <option value="cancelled" @selected(($status ?? '')==='cancelled')>Cancelled</option>
        </select>
        
        <button class="px-6 py-3.5 rounded-2xl bg-slate-900 dark:bg-slate-800 text-white font-black shadow-lg shadow-slate-900/10 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-xl">filter_list</span>
            <span>Filter</span>
        </button>
    </form>
</div>

<div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-left text-xs font-black uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                    <th class="p-6">Order ID</th>
                    <th class="p-6">Customer Details</th>
                    <th class="p-6 text-center">Placed Date</th>
                    <th class="p-6 text-center text-primary">Payment Status</th>
                    <th class="p-6">Delivery Status</th>
                    <th class="p-6 text-right">Quick Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($orders as $o)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="p-6">
                            <div class="flex flex-col">
                                <span class="text-lg font-black text-slate-900 dark:text-white">{{ $o->order_number }}</span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-primary">#ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="font-bold text-slate-900 dark:text-white text-base leading-none">{{ $o->customer_name }}</div>
                            <div class="text-xs text-slate-400 mt-2 font-medium flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-xs">mail</span>
                                {{ $o->customer_email }}
                            </div>
                        </td>
                        <td class="p-6 text-center">
                            <div class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $o->created_at->format('M d, Y') }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tight mt-1">{{ $o->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="p-6 text-center">
                            <span @class([
                                'px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider border flex items-center w-fit mx-auto gap-1.5 shadow-sm',
                                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/10 dark:text-emerald-400 dark:border-emerald-800' => $o->payment_status === 'paid',
                                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/10 dark:text-amber-400 dark:border-amber-800' => $o->payment_status === 'pending',
                                'bg-red-50 text-red-600 border-red-100 dark:bg-red-900/10 dark:text-red-400 dark:border-red-800' => $o->payment_status === 'failed',
                            ])>
                                <span @class([
                                    'h-1.5 w-1.5 rounded-full',
                                    'bg-emerald-500' => $o->payment_status === 'paid',
                                    'bg-amber-500 animate-pulse' => $o->payment_status === 'pending',
                                    'bg-red-500' => $o->payment_status === 'failed',
                                ])></span>
                                {{ $o->payment_status }}
                            </span>
                             <div class="text-[14px] font-black tracking-tight text-slate-800 dark:text-slate-200 mt-2">${{ $o->total }}</div>
                        </td>
                        <td class="p-6">
                            <span @class([
                                'px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider border flex items-center w-fit gap-1.5 shadow-sm',
                                'bg-slate-50 text-slate-600 border-slate-100 dark:bg-slate-900/10 dark:text-slate-400 dark:border-slate-800' => $o->status === 'pending',
                                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/10 dark:text-amber-400 dark:border-amber-800' => $o->status === 'processing',
                                'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-900/10 dark:text-blue-400 dark:border-blue-800' => $o->status === 'shipped',
                                'bg-green-50 text-green-600 border-green-100 dark:bg-green-900/10 dark:text-green-400 dark:border-green-800' => $o->status === 'delivered',
                                'bg-red-50 text-red-600 border-red-100 dark:bg-red-900/10 dark:text-red-400 dark:border-red-800' => $o->status === 'cancelled',
                            ])>
                                <span @class([
                                    'h-1.5 w-1.5 rounded-full',
                                    'bg-slate-400 animate-pulse' => $o->status === 'pending',
                                    'bg-amber-500 animate-pulse' => $o->status === 'processing',
                                    'bg-blue-500' => $o->status === 'shipped',
                                    'bg-green-500' => $o->status === 'delivered',
                                    'bg-red-500' => $o->status === 'cancelled',
                                ])></span>
                                {{ $o->status }}
                            </span>
                        </td>
                        <td class="p-6">
                            <form method="POST" action="{{ route('admin.orders.status', $o) }}" class="flex flex-col items-end gap-1.5">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center gap-2">
                                    <select name="status" class="py-1 px-2 rounded-lg bg-slate-50 dark:bg-slate-800 border-none text-[9px] font-black uppercase tracking-tight focus:ring-1 focus:ring-primary cursor-pointer w-24">
                                        <option value="pending" @selected($o->status==='pending')>Pending</option>
                                        <option value="processing" @selected($o->status==='processing')>Processing</option>
                                        <option value="shipped" @selected($o->status==='shipped')>Shipped</option>
                                        <option value="delivered" @selected($o->status==='delivered')>Delivered</option>
                                        <option value="cancelled" @selected($o->status==='cancelled')>Cancelled</option>
                                    </select>
                                    <button class="p-1.5 rounded-lg bg-slate-900 dark:bg-primary text-white hover:scale-105 active:scale-95 transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-sm leading-none">local_shipping</span>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2">
                                    <select name="payment_status" class="py-1 px-2 rounded-lg bg-slate-50 dark:bg-slate-800 border-none text-[9px] font-black uppercase tracking-tight focus:ring-1 focus:ring-primary cursor-pointer w-24">
                                        <option value="pending" @selected($o->payment_status==='pending')>Pending</option>
                                        <option value="paid" @selected($o->payment_status==='paid')>Paid CP</option>
                                        <option value="failed" @selected($o->payment_status==='failed')>Failed</option>
                                    </select>
                                    <button class="p-1.5 rounded-lg bg-emerald-600 text-white hover:scale-105 active:scale-95 transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-sm leading-none">payments</span>
                                    </button>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.orders.invoice', $o) }}" class="p-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-primary transition-all shadow-sm" title="Get Invoice">
                                        <span class="material-symbols-outlined text-sm leading-none">description</span>
                                    </a>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 mb-20">{{ $orders->links() }}</div>
@endsection