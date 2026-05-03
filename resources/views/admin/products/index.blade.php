@extends('layouts.admin')

@section('title', 'Product Inventory')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Product Inventory</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-sm italic">Manage your store's items and stock levels</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="hidden sm:flex bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-1 rounded-2xl shadow-sm">
            <button class="p-2 rounded-xl bg-slate-50 dark:bg-slate-700 text-slate-900 dark:text-white shadow-inner">
                <span class="material-symbols-outlined">grid_view</span>
            </button>
            <button class="p-2 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                <span class="material-symbols-outlined">list</span>
            </button>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-primary text-white font-black shadow-lg shadow-primary/30 hover:scale-[1.02] active:scale-95 transition-all">
            <span class="material-symbols-outlined">add</span>
            <span>Add Product</span>
        </a>
    </div>
</div>

<div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-left text-xs font-black uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                    <th class="p-6">Product Details</th>
                    <th class="p-6">SKU & Category</th>
                    <th class="p-6">Price</th>
                    <th class="p-6">Stock Status</th>
                    <th class="p-6">Visibility</th>
                    <th class="p-6 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($products as $p)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                    <img class="h-full w-full object-cover" 
                                         src="{{ $p->images->first()->url ?? 'https://placehold.co/200x200?text=' . urlencode($p->name) }}" 
                                         alt="{{ $p->name }}">
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 dark:text-white truncate text-lg leading-tight">{{ $p->name }}</div>
                                    <div class="text-xs text-slate-400 mt-1 font-medium flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-xs leading-none">history</span>
                                        Updated {{ $p->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="p-6">
                            <div class="space-y-1">
                                <div class="inline-flex px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-[10px] font-black tracking-widest text-slate-500 uppercase border border-slate-200 dark:border-slate-700">
                                    {{ $p->sku }}
                                </div>
                                <div class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $p->category->name }}</div>
                            </div>
                        </td>

                        <td class="p-6">
                            <div class="text-lg font-black text-primary">${{ $p->price }}</div>
                            @if($p->compare_at_price)
                                <div class="text-xs text-slate-400 line-through font-bold">${{ $p->compare_at_price }}</div>
                            @endif
                        </td>

                        <td class="p-6">
                            @if($p->stock > 10)
                                <div class="flex flex-col gap-1.5">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $p->stock }} in stock</div>
                                    <div class="w-24 h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-500" style="width: {{ min(100, ($p->stock/100)*100) }}%"></div>
                                    </div>
                                </div>
                            @elseif($p->stock > 0)
                                <div class="flex flex-col gap-1.5">
                                    <div class="text-sm font-bold text-amber-600">Only {{ $p->stock }} left</div>
                                    <div class="w-24 h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500" style="width: 20%"></div>
                                    </div>
                                </div>
                            @else
                                <span class="px-3 py-1 rounded-xl bg-red-50 text-red-600 text-xs font-black uppercase tracking-wider border border-red-100">Out of Stock</span>
                            @endif
                        </td>

                        <td class="p-6">
                            @if($p->is_active)
                                <div class="flex items-center gap-2 text-green-600 font-bold text-sm">
                                    <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                                    Published
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-slate-400 font-bold text-sm">
                                    <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                                    Draft
                                </div>
                            @endif
                        </td>

                        <td class="p-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $p) }}" class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-500 hover:text-primary hover:bg-primary/5 transition-all">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </a>
                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('SURE? This cannot be undone!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-500 hover:text-red-500 hover:bg-red-50 transition-all">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-10 mb-20 flex justify-center">
    <div class="pagination-wrapper p-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm">
        {{ $products->links() }}
    </div>
</div>
@endsection