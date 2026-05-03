@extends('layouts.public')
@section('title', $product->name . ' — Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-white">
    <div class="flex flex-col lg:flex-row gap-12">
        {{-- Left: Gallery Section --}}
        <div class="lg:w-1/2">
            <div class="relative bg-slate-50 border border-slate-100 rounded-lg overflow-hidden group">
                <img id="mainImage" class="w-full h-auto object-cover transition-opacity duration-300" 
                     src="{{ $product->images->first()->url ?? 'https://placehold.co/800x800' }}" alt="{{ $product->name }}">
                
                @if($product->compare_at_price)
                    <div class="absolute top-4 left-4">
                        <img src="https://img.icons8.com/color/48/000000/sale.png" class="w-12 h-12" alt="Sale">
                    </div>
                @endif
                
                <div class="absolute top-4 right-4">
                    <button class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-300 hover:text-red-500 transition-all border border-slate-100 shadow-sm">
                        <span class="material-symbols-outlined text-lg">favorite</span>
                    </button>
                </div>
            </div>
            
            {{-- Thumbnails --}}
            <div class="flex justify-center gap-4 mt-6">
                @foreach($product->images->take(4) as $img)
                    <button onclick="document.getElementById('mainImage').src='{{ $img->url }}'" 
                            class="w-20 h-20 sm:w-28 sm:h-28 rounded border-2 {{ $loop->first ? 'border-black' : 'border-slate-100' }} overflow-hidden hover:border-slate-300 transition-all focus:outline-none">
                        <img class="w-full h-full object-cover" src="{{ $img->url }}" alt="thumb">
                    </button>
                @endforeach
            </div>

            {{-- Frequently Bought Together --}}
            <div class="mt-16">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                   Frequently Bought Together
                </h3>
                <div class="pt-6 border-t border-slate-200">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="w-24 h-32 flex-shrink-0 bg-slate-50 border border-slate-100 rounded overflow-hidden">
                            <img class="w-full h-full object-cover" src="{{ $product->images->first()->url ?? 'https://placehold.co/200x300' }}" alt="">
                        </div>
                        <div class="flex-grow">
                            <h4 class="text-sm font-bold text-slate-800 mb-2 leading-snug">Premium Double PK Cotton Polo - Laurel Oak</h4>
                            <div class="flex items-center gap-3 text-sm mb-4">
                                <span class="font-bold text-black">৳ 1090.00</span>
                                <span class="text-slate-400 line-through">৳ 1290.00</span>
                            </div>
                            <button class="px-5 py-2.5 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded flex items-center gap-2 hover:bg-slate-800 transition-all">
                                <span class="material-symbols-outlined text-xs">add</span> Add To Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Product Details --}}
        <div class="lg:w-1/2">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-6 leading-tight">
                {{ $product->name }}
            </h1>

            <div class="flex items-center gap-4 mb-8">
                <span class="text-2xl font-bold text-black">৳ {{ number_format($product->price) }}</span>
                @if($product->compare_at_price)
                    <span class="text-slate-400 line-through text-sm">৳ {{ number_format($product->compare_at_price) }}</span>
                    <span class="text-red-500 text-xs font-bold">{{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}% Off</span>
                @endif
            </div>

            <form method="POST" action="{{ route('cart.add') }}" class="space-y-8">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Size Selection --}}
                @php $sizes = is_array($product->sizes) ? $product->sizes : json_decode($product->sizes ?? '[]', true); @endphp
                @if(!empty($sizes))
                <div>
                    <span class="block text-sm font-bold text-slate-800 mb-4">Select Size:</span>
                    <div class="flex flex-wrap gap-3">
                        @foreach($sizes as $size)
                            <label class="cursor-pointer group">
                                <input type="radio" name="size" value="{{ $size }}" class="peer sr-only" required>
                                <div class="w-12 h-10 flex items-center justify-center border-2 border-slate-100 rounded text-xs font-bold text-slate-600 peer-checked:border-black peer-checked:text-black group-hover:border-slate-300 transition-all">
                                    {{ $size }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Quantity and Add to Cart --}}
                <div class="flex items-center gap-4 pt-4">
                    <div class="flex items-center border-2 border-slate-100 rounded overflow-hidden h-12">
                        <button type="button" onclick="const input = this.closest('div').querySelector('input'); input.value = Math.max(1, parseInt(input.value) - 1)" class="w-10 flex items-center justify-center text-xl font-bold hover:bg-slate-50 transition-all text-slate-600 border-r border-slate-100">–</button>
                        <input type="number" name="quantity" value="1" min="1" class="w-14 h-full text-center border-none font-bold text-sm focus:ring-0" readonly>
                        <button type="button" onclick="const input = this.closest('div').querySelector('input'); input.value = parseInt(input.value) + 1" class="w-10 flex items-center justify-center text-xl font-bold hover:bg-slate-50 transition-all text-slate-600 border-l border-slate-100">+</button>
                    </div>

                    <button class="flex-grow h-12 bg-black text-white font-bold text-sm uppercase flex items-center justify-center gap-3 rounded hover:bg-slate-800 transition-all disabled:opacity-50"
                            @disabled($product->stock <= 0)>
                        <span class="material-symbols-outlined text-lg">add</span>
                        Add To Cart
                    </button>
                </div>
            </form>

            {{-- Policy Box --}}
            <div class="mt-12">
                <div class="p-6 bg-white border border-slate-100 rounded shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                            <span class="text-sm font-bold text-slate-800">Easy Returns & Exchange</span>
                        </div>
                        <span class="material-symbols-outlined text-slate-300 text-sm">chevron_right</span>
                    </div>
                    <div class="flex flex-wrap gap-4 text-[10px] uppercase font-bold text-slate-400">
                         <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-green-500"></span> Tell us within 7 days</span>
                         <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-green-500"></span> Free return shipping*</span>
                         <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-green-500"></span> Instant refund on receipt</span>
                    </div>
                </div>
            </div>

            {{-- Product Specifications --}}
            <div class="mt-10 space-y-4">
                <p class="text-sm text-slate-500 leading-relaxed">
                    {{ $product->description ?? 'The Polo T-shirt is made with Double PK fabric, featuring premium 80% combed compact organic cotton. The T-shirt has a soft touch, making it very comfortable for all-day wear. It has a regular fit and a shirt collar.' }}
                </p>

                {{-- Key Specs (Dynamic) --}}
                <div class="grid grid-cols-2 gap-y-4 mb-10 pb-8 border-b border-slate-100">
                    <div class="text-sm">
                        <span class="font-bold text-slate-700">Fabric type:</span>
                        <span class="text-slate-500 ml-1 italic">{{ $product->fabric_type ?? 'Premium Cotton' }}</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-bold text-slate-700">Yarn count:</span>
                        <span class="text-slate-500 ml-1 italic">{{ $product->yarn_count ?? '26/1' }}</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-bold text-slate-700">Composition:</span>
                        <span class="text-slate-500 ml-1 italic text-xs">{{ $product->composition ?? '100% Cotton' }}</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-bold text-slate-700">GSM:</span>
                        <span class="text-slate-500 ml-1 italic">{{ $product->gsm ?? '180-200' }}</span>
                    </div>
                    <div class="col-span-2 text-sm mt-2">
                        <span class="font-bold text-slate-700">Color type:</span>
                        <span class="text-slate-500 ml-1 italic text-xs">{{ $product->color_type ?? 'Reactive Dye' }}</span>
                    </div>
                </div>
            </div>

            {{-- Size Chart --}}
            <div class="mt-12" id="sizeChartSection">
                <h3 class="text-sm font-bold text-slate-800 mb-6">Size chart - In <span id="currentUnitText">inches</span> (Expected Deviation < 3%)</h3>
                <div class="flex gap-1 mb-px">
                    <button type="button" onclick="toggleSizeUnit('inch')" id="inchBtn" 
                            class="px-6 py-2 bg-[#f4f4f4] text-xs font-bold border border-slate-100 border-b-0 rounded-t transition-all">INCH</button>
                    <button type="button" onclick="toggleSizeUnit('cm')" id="cmBtn" 
                            class="px-6 py-2 bg-white text-xs font-bold border border-slate-100 border-b-0 rounded-t text-slate-400 transition-all">CM</button>
                </div>
                <div class="overflow-hidden border border-slate-100">
                    <table class="w-full text-xs text-left border-collapse">
                        <thead class="bg-[#fcfcfc] border-b border-slate-100">
                            <tr class="text-slate-500">
                                <th class="px-6 py-4 font-bold">Size</th>
                                <th class="px-6 py-4 font-bold">Chest Round</th>
                                <th class="px-6 py-4 font-bold">Length</th>
                                <th class="px-6 py-4 font-bold">Sleeve</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-slate-600 font-medium" id="sizeChartBody">
                            @php
                                $chart = [
                                    'M' => ['99.1', '69.9', '21'],
                                    'L' => ['102.9', '72.4', '21.6'],
                                    'XL' => ['109.2', '73.7', '22.9'],
                                    '2XL' => ['114.3', '76.2', '24.1']
                                ];
                            @endphp
                            @foreach($chart as $size => $details)
                            <tr class="hover:bg-slate-50/50" data-size="{{ $size }}">
                                <td class="px-6 py-4 font-bold text-black bg-[#fcfcfc]">{{ $size }}</td>
                                <td class="px-6 py-4 size-val" data-inch="{{ $details[0] }}">{{ $details[0] }}</td>
                                <td class="px-6 py-4 size-val" data-inch="{{ $details[1] }}">{{ $details[1] }}</td>
                                <td class="px-6 py-4 size-val" data-inch="{{ $details[2] }}">{{ $details[2] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
                function toggleSizeUnit(unit) {
                    const inchBtn = document.getElementById('inchBtn');
                    const cmBtn = document.getElementById('cmBtn');
                    const unitText = document.getElementById('currentUnitText');
                    const values = document.querySelectorAll('.size-val');

                    if (unit === 'cm') {
                        inchBtn.classList.remove('bg-[#f4f4f4]');
                        inchBtn.classList.add('bg-white', 'text-slate-400');
                        cmBtn.classList.remove('bg-white', 'text-slate-400');
                        cmBtn.classList.add('bg-[#f4f4f4]');
                        unitText.innerText = 'cm';
                        
                        values.forEach(v => {
                            const inchVal = parseFloat(v.getAttribute('data-inch'));
                            v.innerText = (inchVal * 2.54).toFixed(1);
                        });
                    } else {
                        cmBtn.classList.remove('bg-[#f4f4f4]');
                        cmBtn.classList.add('bg-white', 'text-slate-400');
                        inchBtn.classList.remove('bg-white', 'text-slate-400');
                        inchBtn.classList.add('bg-[#f4f4f4]');
                        unitText.innerText = 'inches';
                        
                        values.forEach(v => {
                            v.innerText = v.getAttribute('data-inch');
                        });
                    }
                }
            </script>
        </div>
    </div>

    {{-- Bottom Recommendations Section --}}
    <div class="mt-32">
        <h2 class="text-sm font-bold text-slate-800 mb-12 uppercase tracking-widest pb-4 border-b border-slate-100">You may also like</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach(\App\Models\Product::where('id', '!=', $product->id)->take(12)->get() as $p)
                <div class="group border border-slate-100 rounded overflow-hidden hover:shadow-lg transition-all duration-300">
                    <a href="{{ route('products.show', $p->slug) }}" class="block p-4">
                        <div class="aspect-[3/4] rounded-sm overflow-hidden bg-slate-50 mb-4 relative">
                            <img class="w-full h-full object-cover" src="{{ $p->images->first()->url ?? 'https://placehold.co/400x533' }}" alt="">
                        </div>
                        <div class="text-center">
                            <div class="flex items-center justify-center gap-2 mb-2 text-xs">
                                <span class="font-bold text-black">৳ {{ number_format($p->price) }}</span>
                                @if($p->compare_at_price)
                                    <span class="text-slate-300 line-through">৳ {{ number_format($p->compare_at_price) }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    <button class="w-full py-3 bg-black text-white text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 transition-all">
                        <span class="material-symbols-outlined text-xs">add</span> Add To Cart
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
n