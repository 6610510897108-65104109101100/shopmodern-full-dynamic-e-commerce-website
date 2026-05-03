@extends('layouts.public')
@section('title', 'Order Confirmed — ShopModern')

@section('content')
<div class="max-w-4xl mx-auto py-20 px-6 text-center">
    <div class="mb-12">
        <div class="w-24 h-24 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
            <span class="material-symbols-outlined text-accent text-5xl">check_circle</span>
        </div>
        <h1 class="font-display text-6xl font-black tracking-tighter uppercase italic mb-4">Acquisition Confirmed</h1>
        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Order Identity: #SM-{{ $order->id }}{{ strtoupper(substr(md5($order->id), 0, 4)) }}</p>
    </div>

    <div class="bg-slate-50 rounded-[3rem] p-12 text-left mb-12 border border-slate-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Status Manifest</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-bold text-slate-500">Payment status</span>
                        <span class="text-sm font-black uppercase text-accent">{{ $order->payment_status }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-bold text-slate-500">Logistics status</span>
                        <span class="text-sm font-black uppercase text-black">{{ $order->status }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-bold text-slate-500">Est. Fulfillment</span>
                        <span class="text-sm font-black uppercase text-black">3-5 Business Days</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Dispatch Destination</h3>
                <p class="text-sm font-bold text-black leading-relaxed">
                    {{ $order->customer_name }}<br>
                    {{ $order->shipping_address }}<br>
                    {{ $order->customer_phone }}
                </p>
            </div>
        </div>

        <div class="mt-12 pt-12 border-t border-slate-200">
             <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Items Reserved</h3>
             <div class="space-y-4">
                 @foreach($order->items as $item)
                     <div class="flex justify-between items-center text-sm">
                         <span class="font-bold text-slate-600">{{ $item->product->name }} <span class="text-slate-300 ml-2">× {{ $item->quantity }}</span></span>
                         <span class="font-display font-black text-black">${{ number_format(($item->price_cents * $item->quantity)/100, 2) }}</span>
                     </div>
                 @endforeach
                 <div class="flex justify-between items-center pt-4 mt-4 border-t border-slate-200">
                     <span class="text-xs font-black uppercase text-black">Final Commitment</span>
                     <span class="font-display font-black text-2xl text-black">${{ number_format($order->total_cents/100, 2) }}</span>
                 </div>
             </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('shop') }}" class="px-10 py-5 bg-black text-white font-display font-black text-xs uppercase tracking-widest rounded-2xl hover:scale-105 transition-all shadow-xl">Continue Curating</a>
        <a href="#" onclick="window.print()" class="px-10 py-5 bg-white text-black border-2 border-black font-display font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
            <span class="material-symbols-outlined text-sm">print</span> Print Manifest
        </a>
    </div>
    
    <p class="mt-12 text-[10px] font-black uppercase tracking-widest text-slate-300">A confirmation manifest has been sent to {{ $order->customer_email }}</p>
</div>
@endsection
