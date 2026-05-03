@extends('layouts.public')
@section('title', 'Ready to Wear — ShopModern')

@section('content')
<div class="flex flex-col lg:flex-row gap-16">
    {{-- Sidebar Filters --}}
    <aside class="w-full lg:w-72 shrink-0">
        <div class="sticky top-32 space-y-12">
            <div>
                <h3 class="font-display text-xl font-black tracking-tight mb-6 uppercase">Collections</h3>
                <div class="space-y-4">
                    <a href="{{ route('shop') }}" class="flex items-center justify-between group">
                        <span class="text-sm font-bold {{ !request('category') ? 'text-accent' : 'text-slate-400 group-hover:text-black transition-colors' }}">All Pieces</span>
                        <span class="text-[10px] font-black text-slate-300">/{{ \App\Models\Product::count() }}</span>
                    </a>
                    @foreach($categories as $cat)
                        <a class="flex items-center justify-between group"
                           href="{{ route('shop', array_filter(['category'=>$cat->slug, 'q'=>request('q')])) }}">
                            <span class="text-sm font-bold {{ request('category')===$cat->slug ? 'text-accent' : 'text-slate-400 group-hover:text-black transition-colors' }}">{{ $cat->name }}</span>
                            <span class="text-[10px] font-black text-slate-300">/{{ $cat->products_count ?? '0' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="font-display text-xl font-black tracking-tight mb-6 uppercase">Sort By</h3>
                <div class="space-y-4">
                    @foreach(['newest' => 'Latest Arrivals', 'price_asc' => 'Value First', 'price_desc' => 'Premium Selection'] as $key => $label)
                        <a href="{{ route('shop', array_merge(request()->query(), ['sort' => $key])) }}" 
                           class="flex items-center gap-3 group">
                            <div class="h-4 w-4 rounded-full border-2 {{ request('sort', 'newest') === $key ? 'border-accent bg-accent shadow-lg shadow-accent/20' : 'border-slate-200 group-hover:border-slate-400' }} transition-all"></div>
                            <span class="text-sm font-bold {{ request('sort', 'newest') === $key ? 'text-black' : 'text-slate-400 group-hover:text-black transition-colors' }}">{{ $label }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="pt-10 border-t border-slate-100 italic text-[10px] text-slate-400 leading-relaxed font-medium">
                Our collections are ethically sourced and designed for individuals who appreciate the intersection of minimalism and high-craft.
            </div>
        </div>
    </aside>

    {{-- Product Grid --}}
    <div class="flex-1">
        <div class="flex flex-wrap items-center justify-between gap-8 mb-16">
            <div>
                <h1 class="font-display text-5xl font-black tracking-tighter text-black uppercase">Archive</h1>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Showing {{ $products->count() }} of {{ $products->total() }} pieces</p>
            </div>
            
            @if(request('q'))
                <div class="px-6 py-2 bg-slate-50 rounded-full text-xs font-black text-slate-500 flex items-center gap-3">
                    Search: "{{ request('q') }}"
                    <a href="{{ route('shop', request()->except('q')) }}" class="material-symbols-outlined text-sm leading-none hover:text-black transition-colors">close</a>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-20">
            @foreach($products as $p)
                <div class="group flex flex-col h-full relative">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] bg-slate-50 mb-6 shadow-sm">
                        <a href="{{ route('products.show', $p->slug) }}" class="block h-full">
                            <img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                 src="{{ $p->images->first()->url ?? 'https://placehold.co/800x1200' }}" alt="{{ $p->name }}">
                        </a>
                        
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 pointer-events-none transition-colors duration-500"></div>

                        {{-- Add to Cart Overlay (keeps focus on functionality) --}}
                        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-[80%] translate-y-20 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 z-10">
                             <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                <button class="w-full py-4 bg-white text-black font-display font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl hover:bg-black hover:text-white transition-all shadow-2xl">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('products.show', $p->slug) }}" class="px-2 block flex-grow">
                        <div class="flex justify-between items-start gap-4 mb-2">
                            <h3 class="text-base font-black text-black leading-tight uppercase tracking-tight group-hover:text-amber-600 transition-colors">{{ $p->name }}</h3>
                            <span class="font-display font-black text-xl leading-none text-black">৳{{ $p->price }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $p->category->name }}</span>
                            @if($p->compare_at_price)
                                <span class="text-[10px] font-black text-red-500 line-through opacity-60">৳{{ $p->compare_at_price }}</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-20 border-t border-slate-100 pt-10">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection