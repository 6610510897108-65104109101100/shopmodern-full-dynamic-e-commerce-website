@extends('layouts.public')
@section('title', 'Deals - ShopModern')

@section('content')
<h1 class="text-3xl font-black mb-6">Deals</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($products as $p)
        <div class="bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800">
            <a href="{{ route('products.show', $p->slug) }}" class="block relative aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800">
                <img class="w-full h-full object-cover" src="{{ $p->images->first()->url ?? 'https://placehold.co/600x800' }}" alt="{{ $p->name }}">
                @if($p->discount_percent)
                    <div class="absolute top-4 left-4 px-3 py-1.5 bg-red-600 text-white text-xs font-black rounded-lg">-{{ $p->discount_percent }}%</div>
                @endif
            </a>
            <div class="p-5">
                <div class="font-bold mb-2 line-clamp-1">{{ $p->name }}</div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-2xl font-black text-red-600">${{ $p->price }}</span>
                    @if($p->compare_at_price)<span class="text-base text-slate-400 line-through font-medium">${{ $p->compare_at_price }}</span>@endif
                </div>

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <button class="w-full py-3.5 bg-[#0d141b] dark:bg-white dark:text-[#0d141b] text-white font-bold rounded-xl">
                        Quick Add
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">{{ $products->links() }}</div>
@endsection