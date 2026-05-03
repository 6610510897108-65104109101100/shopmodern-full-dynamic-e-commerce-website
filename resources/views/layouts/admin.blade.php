<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Dashboard') - ShopModern</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { primary: "#137fec", "background-light": "#f8fafc", "background-dark": "#0f172a" },
                    fontFamily: { display: ["Plus Jakarta Sans"] },
                    borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "1rem", "2xl": "1.5rem" },
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
        body { font-family: "Plus Jakarta Sans", sans-serif; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-50 transition-colors duration-200">
<div class="min-h-screen flex flex-col md:flex-row h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-full md:w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col shadow-xl z-20 overflow-y-auto">
        <div class="p-8">
            <div class="flex items-center gap-4 mb-12 group cursor-pointer">
                <div class="h-12 w-12 rounded-2xl bg-primary text-white flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">store</span>
                </div>
                <div>
                    <div class="font-black text-xl tracking-tight leading-none">ShopModern</div>
                    <div class="text-xs text-slate-400 mt-1 font-bold uppercase tracking-widest">Admin Hub</div>
                </div>
            </div>

            <nav class="space-y-1.5 list-none">
                <li class="group">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <span>Products</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">category</span>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.orders.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.customers.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">group</span>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.coupons.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.coupons.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">confirmation_number</span>
                        <span>Coupons</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.reviews.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.reviews.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">reviews</span>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="group">
                    <a href="#" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined">campaign</span>
                        <span>Marketing</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.reports.index') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.reports.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">bar_chart</span>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('admin.settings.edit') }}" 
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                        <span class="material-symbols-outlined">settings</span>
                        <span>Settings</span>
                    </a>
                </li>
            </nav>
        </div>

        <div class="mt-auto p-8 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                <div class="h-10 w-10 rounded-xl bg-slate-200 dark:bg-slate-700 flex items-center justify-center font-black text-slate-500">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-bold truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-red-50 hover:text-red-500 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-lg">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 h-full overflow-y-auto bg-background-light dark:bg-background-dark flex flex-col">
        {{-- Top Header --}}
        <header class="sticky top-0 z-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative group max-w-md w-full hidden md:block">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">search</span>
                    <input type="text" placeholder="Search orders, products..." 
                           class="w-full pl-12 pr-4 py-2.5 rounded-2xl bg-slate-100 dark:bg-slate-800 border-none ring-0 focus:ring-2 focus:ring-primary transition-all text-sm font-medium">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button class="p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 relative transition-all">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2.5 right-2.5 h-2 w-2 rounded-full bg-red-500 border-2 border-white dark:border-slate-900"></span>
                </button>
                <button class="p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-all">
                    <span class="material-symbols-outlined">dark_mode</span>
                </button>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-800 mx-2"></div>
                <div class="flex items-center gap-3 pl-2">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-black text-slate-900 dark:text-white leading-none capitalize">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] font-bold text-primary mt-1 uppercase tracking-widest leading-none">Super Admin</div>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-black text-slate-500 border border-slate-200 dark:border-slate-700">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                @if (session('success'))
                    <div class="mb-8 p-4 rounded-2xl bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-100 dark:border-green-800 flex items-center gap-3 font-semibold shadow-sm">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-8 p-6 rounded-2xl bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-100 dark:border-red-800 shadow-sm">
                        <div class="flex items-center gap-3 font-bold mb-4">
                            <span class="material-symbols-outlined">error</span>
                            <span>Please fix the following errors</span>
                        </div>
                        <ul class="list-disc ml-6 space-y-1 text-sm">
                            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>
</div>
</body>
</html>