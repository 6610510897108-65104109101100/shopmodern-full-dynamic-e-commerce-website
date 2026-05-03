@extends('layouts.admin')
@section('title', 'Site Settings — ShopModern')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Site Settings</h1>
    <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Configure global application parameters</p>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm p-8 max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Hero Section Settings --}}
        <div>
            <h3 class="text-xl font-black tracking-tight text-slate-900 mb-6 uppercase">Homepage Hero Banner</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Background Image</label>
                    @if(isset($settings['hero_image']))
                        <div class="mb-4">
                            <img src="{{ asset($settings['hero_image']) }}" alt="Current Hero Image" class="w-full max-w-md h-auto rounded-xl object-cover shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <p class="text-xs text-slate-400 mt-2">Recommended size: 1920x1080px. Leave empty to keep current.</p>
                    @error('hero_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Main Title</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'NEW SEASON') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-display">
                    @error('hero_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Subtitle</label>
                    <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Autumn / Winter Collectio 2026') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    @error('hero_subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Button Text</label>
                    <input type="text" name="hero_button_text" value="{{ old('hero_button_text', $settings['hero_button_text'] ?? 'Shop Collection') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    @error('hero_button_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Button Link URL</label>
                    <input type="text" name="hero_button_link" value="{{ old('hero_button_link', $settings['hero_button_link'] ?? route('shop')) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-mono">
                    @error('hero_button_link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-8 py-4 bg-primary text-white font-black uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform">
                Save Configurations
            </button>
        </div>
    </form>
</div>
@endsection
