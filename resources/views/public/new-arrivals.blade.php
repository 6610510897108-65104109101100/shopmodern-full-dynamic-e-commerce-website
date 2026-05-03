@extends('layouts.public')
@section('title', 'New Arrivals - ShopModern')

@section('content')
<h1 class="text-3xl font-black mb-6">New Arrivals</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($products as $p)
        <div class="bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800">
            <a href="{{ route('products.show', $p->slug) }}" class="block relative aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800">
                <img class="w-full h-full object-cover" src="{{ $p->images->first()->url ?? 'https://placehold.co/600x800' }}" alt="{{ $p->name }}">
                <div class="absolute top-4 left-4 px-3 py-1 bg-primary text-white text-[10px] font-black rounded-md">NEW</div>
            </a>
            <div class="p-5">
                <div class="text-xs text-[#4c739a] dark:text-slate-400 font-bold uppercase mb-2">{{ $p->category->name }}</div>
                <div class="font-bold mb-2 line-clamp-1">{{ $p->name }}</div>
                <div class="text-xl font-black mb-4">${{ $p->price }}</div>

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <button class="w-full py-3 bg-[#0d141b] dark:bg-white dark:text-[#0d141b] text-white font-bold rounded-xl">
                        Quick Add
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">{{ $products->links() }}</div>
@endsection