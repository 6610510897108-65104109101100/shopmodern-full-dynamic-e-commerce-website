<header class="sticky top-0 z-50 w-full bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-solid border-[#e7edf3] dark:border-slate-800">
    <div class="px-6 md:px-10 py-3 border-b border-solid border-[#e7edf3]/50 dark:border-slate-800/50">
        <div class="max-w-[1280px] mx-auto flex items-center justify-between gap-8">
            <a class="flex items-center gap-3 shrink-0" href="{{ route('home') }}">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white">
                    <span class="material-symbols-outlined">shopping_bag</span>
                </div>
                <h2 class="text-xl font-bold leading-tight tracking-tight text-[#0d141b] dark:text-white">ShopModern</h2>
            </a>

            <div class="flex-1 max-w-2xl hidden md:block">
                <form action="{{ route('shop') }}" method="GET" class="relative flex w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-[#4c739a] dark:text-slate-400">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input name="q" value="{{ request('q') }}"
                           class="w-full h-11 bg-[#e7edf3] dark:bg-slate-800 border-none rounded-xl pl-12 pr-4 text-base focus:ring-2 focus:ring-primary/50 placeholder:text-[#4c739a] dark:placeholder:text-slate-500 text-[#0d141b] dark:text-white"
                           placeholder="Search for products..." type="text"/>
                </form>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('cart') }}" class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-[#e7edf3] dark:bg-slate-800 text-[#0d141b] dark:text-white hover:bg-primary/10 transition-colors">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary text-white hover:bg-primary/90 transition-colors">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary text-white hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">person</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <nav class="px-6 md:px-10 py-0 overflow-x-auto scrollbar-hide">
        <div class="max-w-[1280px] mx-auto flex items-center justify-center gap-12 h-12">
            <a class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary font-semibold border-b-2 border-primary' : 'text-[#4c739a] dark:text-slate-400' }} h-full flex items-center px-1 transition-all"
               href="{{ route('home') }}">Home</a>
            <a class="text-sm font-medium {{ request()->routeIs('shop') ? 'text-primary font-semibold border-b-2 border-primary' : 'text-[#4c739a] dark:text-slate-400' }} h-full flex items-center px-1 transition-all"
               href="{{ route('shop') }}">Shop</a>
            <a class="text-sm font-medium {{ request()->routeIs('deals') ? 'text-primary font-semibold border-b-2 border-primary' : 'text-[#4c739a] dark:text-slate-400' }} h-full flex items-center px-1 transition-all"
               href="{{ route('deals') }}">Deals</a>
            <a class="text-sm font-medium {{ request()->routeIs('new_arrivals') ? 'text-primary font-semibold border-b-2 border-primary' : 'text-[#4c739a] dark:text-slate-400' }} h-full flex items-center px-1 transition-all whitespace-nowrap"
               href="{{ route('new_arrivals') }}">New Arrivals</a>
        </div>
    </nav>
</header>