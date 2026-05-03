@extends('layouts.admin')
@section('title', 'Generate Coupon — ShopModern')

@section('content')
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Generate Coupon</h1>
        <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Configure new discount incentive</p>
    </div>
    <a href="{{ route('admin.coupons.index') }}" class="px-6 py-3 bg-slate-200 text-black font-bold rounded-2xl hover:bg-slate-300 transition-all flex items-center gap-2">
        <span class="material-symbols-outlined">arrow_back</span>
        Back to List
    </a>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm p-8">
    <form action="{{ route('admin.coupons.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Coupon Identity (Code)</label>
                <input type="text" name="code" value="{{ old('code') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-mono">
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Yield Type</label>
                <select name="type" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Currency Units (Fixed)</option>
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                </select>
                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Value</label>
                <input type="number" step="0.01" name="value" value="{{ old('value') }}" required min="0" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Utilization Capacity (Max Uses)</label>
                <input type="number" name="max_uses" value="{{ old('max_uses') }}" min="1" placeholder="Leave empty for infinite" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @error('max_uses') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Starts At</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @error('starts_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Expires At</label>
                <input type="datetime-local" name="expires_at" value="{{ old('expires_at') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                @error('expires_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="md:col-span-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Activate Immediately</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-8 py-4 bg-primary text-white font-black uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform">
                Forge Coupon
            </button>
        </div>
    </form>
</div>
@endsection
