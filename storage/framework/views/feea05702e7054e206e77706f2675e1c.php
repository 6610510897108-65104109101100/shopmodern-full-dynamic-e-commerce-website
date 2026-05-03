

<?php $__env->startSection('title', 'ShopModern — Defined Luxury'); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative h-[80vh] w-full mb-20 overflow-hidden rounded-[3rem] shadow-2xl">
        <img src="<?php echo e(isset($settings['hero_image']) ? asset($settings['hero_image']) : 'file:///C:/Users/User/.gemini/antigravity/brain/77e9f5b9-ccdc-48f8-9fc5-29b51239903a/fashion_hero_banner_1775395815592.png'); ?>" 
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] hover:scale-110" alt="<?php echo e($settings['hero_title'] ?? 'New Season'); ?>">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative h-full flex flex-col justify-center items-center text-center px-6">
            <h1 class="font-display text-7xl md:text-9xl font-black text-white tracking-tighter mb-4 uppercase mix-blend-overlay"><?php echo e($settings['hero_title'] ?? 'NEW SEASON'); ?></h1>
            <p class="text-white/90 text-lg md:text-xl font-medium tracking-[0.3em] uppercase mb-10"><?php echo e($settings['hero_subtitle'] ?? 'Autumn / Winter Collectio 2026'); ?></p>
            <a href="<?php echo e($settings['hero_button_link'] ?? route('shop')); ?>" class="group relative px-12 py-5 bg-white text-black font-display font-black uppercase tracking-widest overflow-hidden transition-all rounded-full hover:px-16">
                <span class="relative z-10"><?php echo e($settings['hero_button_text'] ?? 'Shop Collection'); ?></span>
                <div class="absolute inset-x-0 bottom-0 h-0 bg-primary/10 group-hover:h-full transition-all duration-300"></div>
            </a>
        </div>
    </section>

    
    <section class="mb-32">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h3 class="font-display text-4xl font-black tracking-tight text-primary">Curated Drops</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Explore our latest categories</p>
            </div>
            <a href="<?php echo e(route('shop')); ?>" class="text-xs font-black uppercase tracking-tighter border-b-2 border-primary pb-1">View Archive</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('shop', ['category' => $cat->slug])); ?>" class="group block relative aspect-[4/5] overflow-hidden rounded-[2rem] bg-slate-100">
                    <img class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105" 
                         src="<?php echo e($cat->image_url ?? 'https://placehold.co/800x1000?text=' . $cat->name); ?>" 
                         alt="<?php echo e($cat->name); ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <div class="text-2xl font-display font-black tracking-tighter"><?php echo e($cat->name); ?></div>
                        <div class="text-[10px] font-black uppercase tracking-widest mt-2 flex items-center gap-2">
                             Discover <span class="material-symbols-outlined text-sm">arrow_outward</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="mb-32">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h3 class="font-display text-4xl font-black tracking-tight text-primary">Limited Highlights</h3>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Pieces you shouldn't miss</p>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
            <?php $__currentLoopData = $flashSale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group h-full flex flex-col relative">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-[1.5rem] bg-slate-50 mb-6">
                        <a href="<?php echo e(route('products.show', $p->slug)); ?>" class="block h-full">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 src="<?php echo e($p->images->first()->url ?? 'https://placehold.co/800x1200'); ?>" 
                                 alt="<?php echo e($p->name); ?>">
                        </a>
                        <?php if($p->compare_at_price): ?>
                            <div class="absolute top-6 left-6 px-4 py-1.5 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded-full">Sale</div>
                        <?php endif; ?>
                        
                        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-[85%] translate-y-20 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 z-10">
                             <form method="POST" action="<?php echo e(route('cart.add')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($p->id); ?>">
                                <button class="w-full py-4 bg-white/90 backdrop-blur-md text-black font-display font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-black hover:text-white transition-all shadow-xl">
                                    Quick Addition
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <a href="<?php echo e(route('products.show', $p->slug)); ?>" class="px-2 block flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition-colors leading-tight truncate mr-2"><?php echo e($p->name); ?></h4>
                            <span class="font-display font-bold text-lg leading-none">৳<?php echo e($p->price); ?></span>
                        </div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <?php echo e($p->category->name ?? 'Collection'); ?> 
                            <?php if($p->compare_at_price): ?>
                                <span class="line-through opacity-50">৳<?php echo e($p->compare_at_price); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-32">
        <div class="h-[60vh] rounded-[3rem] bg-slate-900 overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1445205170230-053b83b26 collection- editorial" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80 transition-transform duration-700 group-hover:scale-105" alt="Editorial">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
            <div class="absolute bottom-16 left-16 right-16">
                <span class="text-white/60 font-black uppercase tracking-[0.5em] text-[10px]">The Journal</span>
                <h2 class="text-white text-4xl font-display font-black tracking-tighter mt-4 mb-6">Minimalism: A Way of Living</h2>
                <a href="#" class="inline-flex items-center gap-4 text-white font-black uppercase tracking-widest text-xs border-b-2 border-white pb-2 hover:gap-6 transition-all">Read Story</a>
            </div>
        </div>
        <div class="h-[60vh] rounded-[3rem] bg-slate-100 overflow-hidden relative flex items-center px-16 group">
             <div class="relative z-10">
                <h2 class="text-black text-5xl font-display font-black tracking-tighter leading-[0.9] mb-8 italic">Join the <br>Inner Circle</h2>
                <p class="text-slate-500 font-medium mb-10 max-w-sm">Sign up for early access to limited collections and private sales.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Your essence (Email)" class="flex-1 bg-white border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-primary shadow-lg">
                    <button class="bg-black text-white px-8 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition-all shadow-xl">Join</button>
                </form>
             </div>
             <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-accent/10 rounded-full blur-3xl group-hover:bg-accent/20 transition-all"></div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/public/home.blade.php ENDPATH**/ ?>