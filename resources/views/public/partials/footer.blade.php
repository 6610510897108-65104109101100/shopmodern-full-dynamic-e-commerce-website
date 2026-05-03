<footer class="bg-black text-white dark:bg-slate-900/90 mt-20 pb-10 pt-20 px-6 md:px-10 rounded-t-[3rem] relative overflow-hidden">
    {{-- Background Decoration --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-primary/20 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-[1280px] mx-auto relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-20">
            {{-- Brand Section --}}
            <div class="flex flex-col">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group mb-8 w-fit">
                    <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-xl sm:rounded-2xl bg-white text-black flex items-center justify-center font-black group-hover:scale-105 transition-all shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                        <span class="material-symbols-outlined text-xl sm:text-2xl">local_mall</span>
                    </div>
                    <span class="font-display font-black text-2xl tracking-tighter mix-blend-difference group-hover:pl-1 transition-all">ShopModern</span>
                </a>
                <p class="text-slate-400 font-medium text-sm leading-relaxed mb-8 max-w-xs">
                    Curating the finest minimal aesthetics. Redefining modern luxury through simplicity and quality execution.
                </p>
                <div class="flex items-center gap-3">
                    <a href="#" class="h-10 w-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all hover:-translate-y-1">
                        <span class="material-symbols-outlined text-[20px]">public</span>
                    </a>
                    <a href="#" class="h-10 w-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all hover:-translate-y-1">
                        <span class="material-symbols-outlined text-[20px]">alternate_email</span>
                    </a>
                    <a href="#" class="h-10 w-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all hover:-translate-y-1">
                        <span class="material-symbols-outlined text-[20px]">call</span>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-display font-black text-lg tracking-tight uppercase mb-6 text-white/90">Collections</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('shop') }}" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> All Products</a></li>
                    <li><a href="{{ route('new_arrivals') }}" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> New Arrivals</a></li>
                    <li><a href="{{ route('deals') }}" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> Exclusive Deals</a></li>
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="font-display font-black text-lg tracking-tight uppercase mb-6 text-white/90">Support</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> Contact Us</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> Shipping & Returns</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> FAQ</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white hover:pl-2 transition-all font-medium text-sm flex items-center gap-2 group"><span class="material-symbols-outlined text-[16px] opacity-0 -ml-6 group-hover:opacity-100 group-hover:ml-0 transition-all text-accent">arrow_right_alt</span> Privacy Policy</a></li>
                </ul>
            </div>

            {{-- Connect / Newsletter --}}
            <div>
                <h4 class="font-display font-black text-lg tracking-tight uppercase mb-6 text-white/90">Stay Updated</h4>
                <p class="text-slate-400 font-medium text-sm mb-4 leading-relaxed">Subscribe for early access to drops and exclusive promotions.</p>
                <form class="relative group mt-6" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
                    <input type="email" required placeholder="Email Address" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-slate-500 font-medium text-sm focus:outline-none focus:border-white/30 focus:bg-white/10 focus:ring-1 focus:ring-white/30 transition-all pr-14">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 h-10 w-10 bg-white text-black rounded-xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest text-center md:text-left">
                &copy; {{ date('Y') }} ShopModern. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <!-- Payment methods placeholder styling -->
                <span class="text-xs font-black uppercase tracking-widest text-slate-600 hidden sm:block">Secure Checkout</span>
                <div class="flex gap-2 text-slate-400">
                     <div class="w-10 h-7 bg-white/5 border border-white/10 rounded flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">credit_card</span></div>
                     <div class="w-10 h-7 bg-white/5 border border-white/10 rounded flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">account_balance_wallet</span></div>
                     <div class="w-10 h-7 bg-white/5 border border-white/10 rounded flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">payments</span></div>
                </div>
            </div>
        </div>
    </div>
</footer>
