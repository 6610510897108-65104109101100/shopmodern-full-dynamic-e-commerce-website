<?php $__env->startSection('title', 'Customer Detail: ' . $user->name); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <div class="flex items-center gap-4 mb-2">
        <a href="<?php echo e(route('admin.customers.index')); ?>" class="p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Customer Profile</h1>
    </div>
    <p class="text-slate-500 dark:text-slate-400 font-medium text-sm italic ml-14">Viewing history for <?php echo e($user->name); ?></p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-8 text-center relative overflow-hidden">
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'w-24 h-24 rounded-full mx-auto flex items-center justify-center text-3xl font-black mb-6 border-4 shadow-xl',
                'bg-primary border-primary/20 text-white' => !$user->is_blocked,
                'bg-slate-200 border-slate-300 text-slate-400' => $user->is_blocked,
            ]); ?>">
                <?php echo e(substr($user->name, 0, 1)); ?>

            </div>
            
            <h2 class="text-xl font-black text-slate-900 dark:text-white"><?php echo e($user->name); ?></h2>
            <p class="text-slate-500 font-medium mb-6"><?php echo e($user->email); ?></p>
            
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                <div class="flex flex-col items-center">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-widest">Total Orders</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white"><?php echo e($user->orders->count()); ?></span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-widest">Spent Approx.</span>
                    <span class="text-2xl font-black text-emerald-500">$<?php echo e(number_format($user->orders->sum('total_cents') / 100, 2)); ?></span>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('admin.customers.toggle-block', $user)); ?>" class="mt-8">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button class="w-full py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-lg <?php echo e($user->is_blocked ? 'bg-emerald-500 text-white shadow-emerald-500/20' : 'bg-red-500 text-white shadow-red-500/20'); ?>">
                    <?php echo e($user->is_blocked ? 'Unblock Customer' : 'Block Access'); ?>

                </button>
            </form>
        </div>

        <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <h3 class="text-lg font-black mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">contact_mail</span>
                Contact Support
            </h3>
            <p class="text-slate-400 text-sm font-medium leading-relaxed">System note: This customer has been active since <?php echo e($user->created_at->format('M Y')); ?>. Ensure all support tickets are linked to UID: <?php echo e(str_pad($user->id, 5, '0', STR_PAD_LEFT)); ?>.</p>
        </div>
    </div>

    
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Full Order History</h3>
                <span class="px-4 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800 text-slate-400 text-[10px] font-black uppercase tracking-widest"><?php echo e($user->orders->count()); ?> Entries</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-left text-[10px] font-black uppercase tracking-widest">
                            <th class="p-6">Order ID</th>
                            <th class="p-6">Date</th>
                            <th class="p-6 text-center">Status</th>
                            <th class="p-6 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php $__empty_1 = true; $__currentLoopData = $user->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="group hover:bg-slate-50/30 transition-colors">
                                <td class="p-6">
                                    <span class="font-black text-slate-900 dark:text-white"><?php echo e($order->order_number); ?></span>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-bold text-slate-700 dark:text-slate-300"><?php echo e($order->created_at->format('M d, Y')); ?></div>
                                </td>
                                <td class="p-6 text-center text-[10px] font-black uppercase tracking-widest text-primary">
                                    <?php echo e($order->status); ?>

                                </td>
                                <td class="p-6 text-right">
                                    <div class="text-lg font-black text-slate-900 dark:text-white">$<?php echo e($order->total); ?></div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="p-20 text-center text-slate-400 font-bold italic">No orders found for this customer.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/customers/show.blade.php ENDPATH**/ ?>