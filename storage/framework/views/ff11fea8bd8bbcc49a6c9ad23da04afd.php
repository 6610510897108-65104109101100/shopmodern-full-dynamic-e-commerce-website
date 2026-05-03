<?php $__env->startSection('title', 'Client Portfolio — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10 mb-16">
    <div>
        <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Client Portfolio</h1>
        <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Nurture Your High-Value Base</p>
    </div>

    <form method="GET" action="<?php echo e(route('admin.customers.index')); ?>" class="relative w-full lg:w-96 group">
        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-black transition-colors">person_search</span>
        <input name="q" value="<?php echo e($q ?? ''); ?>" placeholder="Identify customer..." 
               class="w-full pl-14 pr-6 py-4 bg-white dark:bg-slate-900 border-none ring-1 ring-slate-200 dark:ring-slate-800 focus:ring-2 focus:ring-black rounded-[2rem] transition-all font-bold text-sm shadow-sm">
    </form>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-50 dark:border-slate-800">
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Identity</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Electronic Contact</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400 text-center">Engagement</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400 text-center">Inception</th>
                    <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Access Status</th>
                    <th class="px-8 py-6"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-12 h-12 rounded-full flex items-center justify-center font-black text-xs uppercase border-2',
                                'bg-black text-white border-black' => !$c->is_blocked,
                                'bg-slate-50 text-slate-300 border-slate-100' => $c->is_blocked,
                            ]); ?>">
                                <?php echo e(substr($c->name, 0, 1)); ?>

                            </div>
                            <div class="flex flex-col">
                                <span class="text-base font-black text-black dark:text-white uppercase tracking-tight leading-none mb-1"><?php echo e($c->name); ?></span>
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-300">Client #<?php echo e(str_pad($c->id, 5, '0', STR_PAD_LEFT)); ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-400"><?php echo e($c->email); ?></span>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="inline-block px-4 py-1 rounded-full bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700">
                            <span class="text-xs font-black text-black dark:text-white"><?php echo e($c->orders_count); ?> Orders</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="text-[10px] font-black uppercase tracking-tighter text-slate-400"><?php echo e($c->created_at->format('M d, Y')); ?></span>
                    </td>
                    <td class="px-8 py-6">
                        <?php if($c->is_blocked): ?>
                            <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest bg-red-50 text-red-600 rounded-full border border-red-100 flex items-center w-fit gap-2">
                                <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span> Blocked
                            </span>
                        <?php else: ?>
                            <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600 rounded-full border border-emerald-100 flex items-center w-fit gap-2">
                                <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-pulse"></span> Active
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="<?php echo e(route('admin.customers.show', $c)); ?>" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-black transition-all" title="View Portfolio">
                                <span class="material-symbols-outlined text-lg">description</span>
                            </a>
                            
                            <form method="POST" action="<?php echo e(route('admin.customers.toggle-block', $c)); ?>" onsubmit="return confirm('Authorize access change?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button class="p-2.5 rounded-xl transition-all <?php echo e($c->is_blocked ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white' : 'bg-red-50 text-red-500 hover:bg-red-500 hover:text-white'); ?>">
                                    <span class="material-symbols-outlined text-lg">
                                        <?php echo e($c->is_blocked ? 'verified' : 'block'); ?>

                                    </span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-10 mb-20">
    <?php echo e($customers->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>