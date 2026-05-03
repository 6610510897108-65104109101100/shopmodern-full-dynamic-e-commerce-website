@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="mb-10">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.products.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Add New Product</h1>
    </div>
    <p class="text-slate-500 dark:text-slate-400 font-medium text-sm italic ml-14">List a new item in your store inventory</p>
</div>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
      class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none p-8 lg:p-12 mb-20 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 p-8 opacity-5 dark:opacity-10 pointer-events-none">
        <span class="material-symbols-outlined text-9xl">inventory_2</span>
    </div>

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
        {{-- Basic Information Section --}}
        <div class="md:col-span-2 border-l-4 border-primary pl-4 mb-2">
            <h2 class="text-xl font-black text-slate-900 dark:text-white">Basic Information</h2>
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Product Name</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">title</span>
                <input name="name" placeholder="e.g. Premium Cotton T-Shirt" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary dark:focus:ring-primary transition-all font-bold" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">SKU Code</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">barcode</span>
                <input name="sku" placeholder="SKU-12345" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary dark:focus:ring-primary transition-all font-bold uppercase tracking-wider" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Category</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">category</span>
                <select name="category_id" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-bold appearance-none" required>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Pricing Section --}}
        <div class="md:col-span-2 border-l-4 border-amber-400 pl-4 mt-4 mb-2">
            <h2 class="text-xl font-black text-slate-900 dark:text-white">Pricing & Inventory</h2>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Size Options</label>
            <div class="flex flex-wrap gap-2">
                @foreach(['S', 'M', 'L', 'XL', '2XL', '3XL'] as $size)
                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 font-black text-xs text-slate-500 hover:border-primary transition-colors cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="{{ $size }}" class="rounded text-primary focus:ring-primary border-slate-300">
                        {{ $size }}
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Color Options</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">palette</span>
                <input name="colors_raw" placeholder="Red, Blue, Black..." class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-bold">
            </div>
            <p class="text-[9px] text-slate-400 mt-2 font-bold uppercase tracking-widest italic ml-1">Separate colors with commas (e.g. Vintage Black, Slate Gray)</p>
        </div>

        {{-- Technical Specifications Section --}}
        <div class="md:col-span-2 border-l-4 border-indigo-400 pl-4 mt-4 mb-2">
            <h2 class="text-xl font-black text-slate-900 dark:text-white">Technical Specifications</h2>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Fabric Type</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">texture</span>
                <input name="fabric_type" placeholder="e.g. Double PK" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Yarn Count</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">reorder</span>
                <input name="yarn_count" placeholder="e.g. 26/1" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Composition</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">science</span>
                <input name="composition" placeholder="e.g. 80% Cotton + 20% Polyester" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">GSM (Weight)</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">fitness_center</span>
                <input name="gsm" placeholder="e.g. 210-220" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Color Treatment Type</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">stains</span>
                <input name="color_type" placeholder="e.g. Reactive Dye, Enzyme Washed" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Selling Price (৳)</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors font-bold">currency_lira</span>
                <input name="price" type="number" step="0.01" placeholder="1090" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-black text-primary text-lg" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Compare Price (৳)</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors font-bold text-sm">currency_lira</span>
                <input name="compare_at_price" type="number" step="0.01" placeholder="1290" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-bold text-slate-400">
            </div>
        </div>

        <div>
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Stock Quantity</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">production_quantity_limits</span>
                <input name="stock" type="number" placeholder="100" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-bold" required>
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6 ml-1">
            <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="absolute w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer peer checked:bg-primary checked:right-0 right-6 transition-all duration-300" checked>
                <label for="is_active" class="block w-12 h-6 overflow-hidden bg-slate-200 dark:bg-slate-700 rounded-full cursor-pointer peer-checked:bg-primary/30"></label>
            </div>
            <label for="is_active" class="text-sm font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider">Active & Visible</label>
        </div>

        {{-- Assets Section --}}
        <div class="md:col-span-2 border-l-4 border-green-500 pl-4 mt-4 mb-2">
            <h2 class="text-xl font-black text-slate-900 dark:text-white">Media & description</h2>
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Upload Product Images (Max 5MB each)</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">cloud_upload</span>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-bold file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
            </div>
            <p class="text-[10px] text-slate-400 mt-2 ml-4 font-bold uppercase tracking-widest italic">You can select multiple files from your device (JPG, PNG, WEBP)</p>
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Detailed Description</label>
            <textarea name="description" rows="4" placeholder="Tell your customers more about this item..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-primary transition-all font-medium text-slate-700 dark:text-slate-300 min-h-[120px]"></textarea>
        </div>

        {{-- Submit Button --}}
        <div class="md:col-span-2 mt-8">
            <button class="w-full py-5 rounded-2xl bg-primary text-white font-black text-xl shadow-xl shadow-primary/30 hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-2xl">save</span>
                Create Product & Go Live
            </button>
        </div>
    </div>
</form>
@endsection