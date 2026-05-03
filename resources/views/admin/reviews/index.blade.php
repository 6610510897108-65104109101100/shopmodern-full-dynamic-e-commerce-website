@extends('layouts.admin')
@section('title', 'Sentiment Analysis — ShopModern')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Sentiment Analysis</h1>
    <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Moderate Customer Echoes</p>
</div>

<div class="grid grid-cols-1 gap-8">
    @forelse($reviews as $r)
    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-10 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:scale-[1.01] transition-all group">
        <div class="flex flex-col md:flex-row justify-between items-start gap-8">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex text-amber-400">
                        @for($i=1; $i<=5; $i++)
                            <span class="material-symbols-outlined text-sm {{ $i <= $r->rating ? 'fill-current' : 'text-slate-200 dark:text-slate-700' }}">star</span>
                        @endfor
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">/ {{ $r->rating }} Units</span>
                </div>
                
                <h4 class="text-lg font-black text-black dark:text-white uppercase tracking-tight mb-4 leading-relaxed italic">"{{ $r->comment }}"</h4>
                
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                         <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-black text-[10px] text-slate-500 uppercase">{{ substr($r->user->name ?? 'A', 0, 1) }}</div>
                         <div class="text-xs font-bold text-slate-600 dark:text-slate-400">
                             {{ $r->user->name ?? 'Anonymous Client' }}
                         </div>
                    </div>
                    <div class="text-xs font-black uppercase tracking-tighter text-slate-400 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">inventory_2</span>
                        {{ $r->product->name ?? 'Defunct Item' }}
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col items-end justify-between min-h-[100px] w-full md:w-auto">
                <div class="text-[10px] font-black uppercase tracking-widest text-slate-300">{{ $r->created_at->format('M d, Y') }}</div>
                <div class="flex items-center gap-3 mt-8 md:mt-0 opacity-0 group-hover:opacity-100 transition-opacity">
                    <form action="{{ route('admin.reviews.destroy', $r) }}" method="POST" onsubmit="return confirm('Suppress this echo?')">
                        @csrf @method('DELETE')
                        <button class="px-6 py-2 bg-red-50 text-red-500 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-red-500 hover:text-white transition-all shadow-sm">
                            Suppress
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="py-32 text-center rounded-[3rem] bg-slate-50 border-2 border-dashed border-slate-200">
         <span class="material-symbols-outlined text-6xl text-slate-200 mb-6 font-thin">reviews</span>
         <h2 class="text-2xl font-display font-black text-slate-400 uppercase tracking-tight">No echoes detected in the system</h2>
    </div>
    @endforelse
</div>

<div class="mt-10">
    {{ $reviews->links() }}
</div>
@endsection
