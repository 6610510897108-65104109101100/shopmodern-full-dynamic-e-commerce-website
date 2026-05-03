
<?php $__env->startSection('title', 'Finalize Acquisition — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-16">
    <h1 class="font-display text-5xl font-black tracking-tighter uppercase italic">Secure Acquisition</h1>
    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Final Step to Ownership</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-20 items-start">
    
    <form method="POST" action="<?php echo e(route('checkout.place')); ?>" class="lg:col-span-7 space-y-12">
        <?php echo csrf_field(); ?>
        
        <section>
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-black mb-8 pb-4 border-b border-black/5">01. Delivery Coordinates</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Legal Name</label>
                    <input name="customer_name" value="<?php echo e(auth()->user()->name ?? ''); ?>" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-bold text-sm focus:ring-1 focus:ring-black" placeholder="John Doe" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Electronic Mail</label>
                    <input name="customer_email" type="email" value="<?php echo e(auth()->user()->email ?? ''); ?>" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-bold text-sm focus:ring-1 focus:ring-black" placeholder="john@example.com" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Mobile Contact</label>
                    <input name="customer_phone" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-bold text-sm focus:ring-1 focus:ring-black" placeholder="+880 1XXX XXXXXX">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Physical Destination</label>
                    <textarea name="shipping_address" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl font-bold text-sm focus:ring-1 focus:ring-black" rows="3" placeholder="Street, Apartment, Post Code" required></textarea>
                </div>
            </div>
        </section>

        <section>
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-black mb-8 pb-4 border-b border-black/5">02. Method of Transfer</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="relative block cursor-pointer group">
                    <input type="radio" name="payment_method" value="stripe" class="peer sr-only" checked>
                    <div class="p-6 border-2 border-slate-100 rounded-[2rem] peer-checked:border-black transition-all bg-white relative overflow-hidden">
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-slate-400 mb-2">credit_card</span>
                            <div class="font-black text-xs uppercase tracking-widest">Credit Card</div>
                            <div class="text-[9px] text-slate-400 font-bold mt-1 uppercase">Instant Activation</div>
                        </div>
                        <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-slate-50 rounded-full blur-xl group-hover:bg-slate-100 transition-all"></div>
                    </div>
                </label>
                
                <label class="relative block cursor-pointer group">
                    <input type="radio" name="payment_method" value="cod" class="peer sr-only">
                    <div class="p-6 border-2 border-slate-100 rounded-[2rem] peer-checked:border-black transition-all bg-white relative overflow-hidden">
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-slate-400 mb-2">local_shipping</span>
                            <div class="font-black text-xs uppercase tracking-widest">Upon Arrival</div>
                            <div class="text-[9px] text-slate-400 font-bold mt-1 uppercase">Cash Flow Management</div>
                        </div>
                        <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-slate-50 rounded-full blur-xl group-hover:bg-slate-100 transition-all"></div>
                    </div>
                </label>
            </div>
        </section>

        <div class="pt-10">
            <button class="w-full py-6 bg-black text-white font-display font-black text-sm uppercase tracking-[0.3em] rounded-3xl hover:bg-accent transition-all shadow-2xl flex items-center justify-center gap-4">
                Execute Order <span class="material-symbols-outlined text-xl">verified_user</span>
            </button>
            <p class="text-[9px] text-center font-black text-slate-300 uppercase tracking-widest mt-6">By clicking, you agree to our terms of refined commerce.</p>
        </div>
    </form>

    
    <div class="lg:col-span-5 sticky top-32">
        <div class="p-10 bg-slate-50 rounded-[3rem] border border-slate-100">
            <h2 class="font-display text-2xl font-black tracking-tighter uppercase mb-10">Order Manifest</h2>
            <div class="space-y-8">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex gap-6 items-center">
                        <div class="w-20 h-24 rounded-2xl overflow-hidden bg-white shrink-0 shadow-sm">
                            <img class="w-full h-full object-cover" src="<?php echo e($item->product->images->first()->url ?? 'https://placehold.co/200x300'); ?>" alt="">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-black text-black leading-tight uppercase mb-1"><?php echo e($item->product->name); ?></h4>
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?php echo e($item->quantity); ?> × $<?php echo e($item->product->price); ?></span>
                                <span class="font-display font-black text-lg leading-none">$<?php echo e(number_format(($item->product->price_cents * $item->quantity)/100, 2)); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-10 pt-10 border-t border-slate-200 space-y-4">
                <div class="flex justify-between items-end">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Net Value</span>
                    <span class="font-display font-black text-xl leading-none italic">$<?php echo e(number_format($totals['subtotalCents']/100, 2)); ?></span>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Logistics</span>
                    <span class="font-display font-black text-xl leading-none italic">
                        <?php if($totals['shippingCents'] > 0): ?>
                            $<?php echo e(number_format($totals['shippingCents']/100, 2)); ?>

                        <?php else: ?>
                            <span class="text-accent underline decoration-accent/20 underline-offset-4">Complimentary</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="pt-6 mt-6 border-t border-slate-900 border-dashed">
                    <div class="flex justify-between items-end">
                        <span class="text-xs font-black uppercase tracking-widest text-black">Grand Total</span>
                        <span class="font-display font-black text-4xl leading-none text-black">$<?php echo e(number_format($totals['totalCents']/100, 2)); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 p-6 bg-white rounded-2xl border border-slate-200 border-dashed text-center">
                 <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-relaxed">Your acquisition is protected by our <br>Refined Commerce Guarantee.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/public/checkout.blade.php ENDPATH**/ ?>