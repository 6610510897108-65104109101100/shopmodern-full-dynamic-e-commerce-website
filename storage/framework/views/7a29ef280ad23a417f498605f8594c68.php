<?php $__env->startSection('title', 'Collections — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black tracking-tight text-slate-900 dark:text-white uppercase italic">Collections</h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium text-sm mt-1 italic">Organize your inventory into stylish categories</p>
        </div>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            New Category
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="group bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-6 flex flex-col items-center text-center transition-all hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-none hover:-translate-y-2">
            <div class="relative w-full aspect-[4/5] rounded-[2rem] overflow-hidden bg-slate-50 dark:bg-slate-800 mb-8 shadow-inner">
                <img src="<?php echo e($cat->image_url); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="<?php echo e($cat->name); ?>">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>

            <div class="flex-grow w-full">
                <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-2"><?php echo e($cat->name); ?></h3>
                <p class="text-[10px] font-black text-primary uppercase tracking-[0.3em] mb-4"><?php echo e($cat->products_count); ?> PIECES</p>
                <p class="text-xs text-slate-400 dark:text-slate-500 font-medium line-clamp-2 px-4 italic mb-8">
                    <?php echo e($cat->description ?? 'No description provided for this collection.'); ?>

                </p>
            </div>

            <div class="w-full flex items-center justify-center gap-3 border-t border-slate-50 dark:border-slate-800/50 pt-6">
                <a href="<?php echo e(route('admin.categories.edit', $cat)); ?>" class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </a>
                <form action="<?php echo e(route('admin.categories.destroy', $cat)); ?>" method="POST" onsubmit="return confirm('Archive this entire collection?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all">
                        <span class="material-symbols-outlined text-lg">delete</span>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-20">
    <?php echo e($categories->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>