<?php $__env->startSection('title', 'Promotional Controls — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Promotional Manifest</h1>
        <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Manage Discount Incentives</p>
    </div>
    <a href="<?php echo e(route('admin.coupons.create')); ?>" class="px-6 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-primary/25 hover:scale-105 transition-all flex items-center gap-2">
        <span class="material-symbols-outlined">add</span>
        Generate Coupon
    </a>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-50 dark:border-slate-800">
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Coupon Identity</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Yield Type</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Value</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Temporal Range</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Utilization</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Status</th>
                    <th class="px-8 py-6"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-8 py-6">
                        <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-black dark:text-white font-mono font-black rounded-xl border border-slate-200 dark:border-slate-700 tracking-wider">
                            <?php echo e($c->code); ?>

                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-xs font-black uppercase tracking-widest text-slate-600 dark:text-slate-300">
                            <?php echo e($c->type === 'fixed' ? 'Currency Units' : 'Percentage'); ?>

                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-lg font-black text-primary">
                            <?php echo e($c->type === 'fixed' ? '$' : ''); ?><?php echo e($c->value); ?><?php echo e($c->type === 'percent' ? '%' : ''); ?>

                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">
                            Starts: <?php echo e($c->starts_at ? $c->starts_at->format('M d, Y') : 'Immediate'); ?><br>
                            Ends: <?php echo e($c->expires_at ? $c->expires_at->format('M d, Y') : 'Perpetual'); ?>

                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm font-black text-slate-700 dark:text-slate-200">
                            <?php echo e($c->used_count ?? 0); ?> <span class="text-slate-400 font-bold">/ <?php echo e($c->max_uses ?? '∞'); ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full <?php echo e($c->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo e($c->is_active ? 'Active' : 'Inactive'); ?>

                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="<?php echo e(route('admin.coupons.edit', $c)); ?>" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="<?php echo e(route('admin.coupons.destroy', $c)); ?>" method="POST" onsubmit="return confirm('Archive this coupon?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="p-2 hover:bg-red-50 text-red-500 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php if($coupons->hasPages()): ?>
    <div class="p-8 border-t border-slate-50 dark:border-slate-800">
        <?php echo e($coupons->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/coupons/index.blade.php ENDPATH**/ ?>