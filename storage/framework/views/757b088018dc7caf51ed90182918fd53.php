
<?php $__env->startSection('title', 'Deals - ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-black mb-6">Deals</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-800">
            <a href="<?php echo e(route('products.show', $p->slug)); ?>" class="block relative aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800">
                <img class="w-full h-full object-cover" src="<?php echo e($p->images->first()->url ?? 'https://placehold.co/600x800'); ?>" alt="<?php echo e($p->name); ?>">
                <?php if($p->discount_percent): ?>
                    <div class="absolute top-4 left-4 px-3 py-1.5 bg-red-600 text-white text-xs font-black rounded-lg">-<?php echo e($p->discount_percent); ?>%</div>
                <?php endif; ?>
            </a>
            <div class="p-5">
                <div class="font-bold mb-2 line-clamp-1"><?php echo e($p->name); ?></div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-2xl font-black text-red-600">$<?php echo e($p->price); ?></span>
                    <?php if($p->compare_at_price): ?><span class="text-base text-slate-400 line-through font-medium">$<?php echo e($p->compare_at_price); ?></span><?php endif; ?>
                </div>

                <form method="POST" action="<?php echo e(route('cart.add')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($p->id); ?>">
                    <button class="w-full py-3.5 bg-[#0d141b] dark:bg-white dark:text-[#0d141b] text-white font-bold rounded-xl">
                        Quick Add
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-8"><?php echo e($products->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/public/deals.blade.php ENDPATH**/ ?>