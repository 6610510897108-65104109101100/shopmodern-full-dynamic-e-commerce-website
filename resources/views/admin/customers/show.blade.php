@extends('layouts.admin')

@section('title', 'Customer Detail: ' . $user->name)

@section('content')
<div class="mb-10">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.customers.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Customer Profile</h1>
    </div>
    <p class="text-slate-500 dark:text-slate-400 font-medium text-sm italic ml-14">Viewing history for {{ $user->name }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Profile Sidebar --}}
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-8 text-center relative overflow-hidden">
            <div @class([
                'w-24 h-24 rounded-full mx-auto flex items-center justify-center text-3xl font-black mb-6 border-4 shadow-xl',
                'bg-primary border-primary/20 text-white' => !$user->is_blocked,
                'bg-slate-200 border-slate-300 text-slate-400' => $user->is_blocked,
            ])>
                {{ substr($user->name, 0, 1) }}
            </div>
            
            <h2 class="text-xl font-black text-slate-900 dark:text-white">{{ $user->name }}</h2>
            <p class="text-slate-500 font-medium mb-6">{{ $user->email }}</p>
            
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                <div class="flex flex-col items-center">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-widest">Total Orders</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">{{ $user->orders->count() }}</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-widest">Spent Approx.</span>
                    <span class="text-2xl font-black text-emerald-500">${{ number_format($user->orders->sum('total_cents') / 100, 2) }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.customers.toggle-block', $user) }}" class="mt-8">
                @csrf
                @method('PATCH')
                <button class="w-full py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-lg {{ $user->is_blocked ? 'bg-emerald-500 text-white shadow-emerald-500/20' : 'bg-red-500 text-white shadow-red-500/20' }}">
                    {{ $user->is_blocked ? 'Unblock Customer' : 'Block Access' }}
                </button>
            </form>
        </div>

        <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <h3 class="text-lg font-black mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">contact_mail</span>
                Contact Support
            </h3>
            <p class="text-slate-400 text-sm font-medium leading-relaxed">System note: This customer has been active since {{ $user->created_at->format('M Y') }}. Ensure all support tickets are linked to UID: {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}.</p>
        </div>
    </div>

    {{-- Order History --}}
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Full Order History</h3>
                <span class="px-4 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800 text-slate-400 text-[10px] font-black uppercase tracking-widest">{{ $user->orders->count() }} Entries</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-left text-[10px] font-black uppercase tracking-widest">
                            <th class="p-6">Order ID</th>
                            <th class="p-6">Date</th>
                            <th class="p-6 text-center">Status</th>
                            <th class="p-6 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($user->orders as $order)
                            <tr class="group hover:bg-slate-50/30 transition-colors">
                                <td class="p-6">
                                    <span class="font-black text-slate-900 dark:text-white">{{ $order->order_number }}</span>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="p-6 text-center text-[10px] font-black uppercase tracking-widest text-primary">
                                    {{ $order->status }}
                                </td>
                                <td class="p-6 text-right">
                                    <div class="text-lg font-black text-slate-900 dark:text-white">${{ $order->total }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center text-slate-400 font-bold italic">No orders found for this customer.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
