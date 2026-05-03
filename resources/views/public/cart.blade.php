@extends('layouts.public')
@section('title', 'Shopping Vault — ShopModern')

@section('content')
<div class="mb-16">
    <h1 class="font-display text-5xl font-black tracking-tighter uppercase italic">Shopping Vault</h1>
    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Inventory Reserved for You ({{ $items->count() }} Pieces)</p>
</div>

@if($items->isEmpty())
    <div class="py-32 text-center rounded-[3rem] bg-slate-50 border-2 border-dashed border-slate-200">
        <span class="material-symbols-outlined text-6xl text-slate-200 mb-6 font-thin">shopping_bag</span>
        <h2 class="text-2xl font-display font-black text-slate-400 uppercase tracking-tight">Your vault is currently empty</h2>
        <a href="{{ route('shop') }}" class="mt-8 inline-block px-10 py-4 bg-black text-white font-black uppercase tracking-widest text-xs rounded-2xl hover:scale-105 transition-all">Go Shop</a>
    </div>
@else
    <div class="flex flex-col lg:flex-row gap-16 items-start">
        <div class="flex-1 w-full">
            <div class="space-y-10">
                @foreach($items as $item)
                    @php($p = $item->product)
                    <div class="flex flex-col sm:flex-row gap-8 pb-10 border-b border-slate-100 group">
                        <div class="w-full sm:w-40 aspect-[3/4] rounded-3xl overflow-hidden bg-slate-50 shadow-sm">
                            <img class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 src="{{ $p->images->first()->url ?? 'https://placehold.co/400x600' }}" alt="{{ $p->name }}">
                        </div>
                        <div class="flex-1 flex flex-col justify-between py-2">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-2xl font-display font-black text-black tracking-tighter uppercase leading-none mb-2">{{ $p->name }}</h3>
                                        <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                            <span>Collection: {{ $p->category->name }}</span>
                                            @if($item->size) <span>Size: {{ $item->size }}</span> @endif
                                            @if($item->color) <span>Color: {{ $item->color }}</span> @endif
                                        </div>
                                    </div>
                                    <span class="text-2xl font-display font-black text-black leading-none">${{ $p->price }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mt-8">
                                <div class="flex items-center gap-4">
                                    <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center bg-slate-50 rounded-2xl p-1 border border-slate-100">
                                        @csrf
                                        @method('PATCH')
                                        <button name="quantity" value="{{ max(1, $item->quantity - 1) }}" class="w-10 h-10 flex items-center justify-center font-black text-lg hover:text-accent transition-colors disabled:opacity-20" @disabled($item->quantity <= 1)>-</button>
                                        <span class="w-10 text-center font-display font-black text-sm">{{ $item->quantity }}</span>
                                        <button name="quantity" value="{{ $item->quantity + 1 }}" class="w-10 h-10 flex items-center justify-center font-black text-lg hover:text-accent transition-colors">+</button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 transition-colors underline underline-offset-4">Discard</button>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] font-black uppercase tracking-widest text-slate-300 mb-1">Subtotal Value</span>
                                    <span class="text-xl font-display font-black text-black leading-none">${{ number_format(($p->price_cents * $item->quantity)/100, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-full lg:w-[400px] sticky top-32">
            <div class="bg-black text-white rounded-[3rem] p-10 shadow-2xl">
                <h2 class="font-display text-3xl font-black tracking-tighter uppercase italic mb-10">Cart Summary</h2>

                <div class="space-y-6">
                    <div class="flex justify-between items-end">
                        <span class="text-white/40 font-black uppercase tracking-widest text-[10px]">Vault Subtotal</span>
                        <span class="font-display font-black text-2xl">${{ number_format($totals['subtotalCents']/100, 2) }}</span>
                    </div>

                    <div class="flex justify-between items-end">
                        <span class="text-white/40 font-black uppercase tracking-widest text-[10px]">Est. Logistics</span>
                        <span class="font-display font-black text-2xl">
                            @if($totals['shippingCents'] > 0)
                                ${{ number_format($totals['shippingCents']/100, 2) }}
                            @else
                                <span class="text-accent italic">Complimentary</span>
                            @endif
                        </span>
                    </div>

                    <div class="pt-10 border-t border-white/10 mt-10">
                        <div class="flex justify-between items-end mb-10">
                            <span class="text-white font-black uppercase tracking-widest text-xs">Total Commitment</span>
                            <span class="font-display font-black text-5xl leading-none italic underline decoration-accent underline-offset-4">${{ number_format($totals['totalCents']/100, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="group w-full block py-6 bg-accent text-white font-display font-black text-sm uppercase tracking-[0.2em] rounded-3xl hover:bg-white hover:text-black transition-all text-center shadow-xl shadow-accent/20">
                            Continue to Secured Checkout
                        </a>
                        
                        <div class="mt-8 flex items-center justify-center gap-4 text-[9px] font-black uppercase tracking-[0.2em] text-white/30">
                            <span class="material-symbols-outlined text-sm">lock</span>
                            Secure encrypted transaction
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 p-8 border-2 border-slate-100 rounded-[2.5rem]">
                 <span class="block text-[10px] font-black uppercase tracking-widest text-black mb-4">Promotional Code</span>
                 <form class="flex gap-2">
                     <input type="text" placeholder="Enter essence" class="flex-1 bg-slate-50 border-none rounded-2xl px-5 py-3 font-bold text-xs focus:ring-1 focus:ring-accent">
                     <button class="px-6 py-3 bg-black text-white rounded-2xl font-black uppercase tracking-widest text-[10px] hover:scale-105 transition-all">Apply</button>
                 </form>
            </div>
        </div>
    </div>
@endif
@endsection