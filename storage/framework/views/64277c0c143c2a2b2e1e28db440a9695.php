<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Good Morning, Admin!</h1>
    <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-sm italic">Here's what's happening with your store today.</p>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:shadow-lg transition-all">
        <div class="h-14 w-14 rounded-2xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
            <span class="material-symbols-outlined text-3xl">shopping_bag</span>
        </div>
        <div>
            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Orders</div>
            <div class="text-2xl font-black text-slate-900 dark:text-white"><?php echo e($totalOrders); ?></div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:shadow-lg transition-all">
        <div class="h-14 w-14 rounded-2xl bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
            <span class="material-symbols-outlined text-3xl">payments</span>
        </div>
        <div>
            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Revenue</div>
            <div class="text-2xl font-black text-slate-900 dark:text-white">$<?php echo e(number_format($totalRevenueCents / 100, 2)); ?></div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:shadow-lg transition-all">
        <div class="h-14 w-14 rounded-2xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
            <span class="material-symbols-outlined text-3xl">group</span>
        </div>
        <div>
            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Customers</div>
            <div class="text-2xl font-black text-slate-900 dark:text-white"><?php echo e($totalCustomers); ?></div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:shadow-lg transition-all">
        <div class="h-14 w-14 rounded-2xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
            <span class="material-symbols-outlined text-3xl">inventory_2</span>
        </div>
        <div>
            <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Products</div>
            <div class="text-2xl font-black text-slate-900 dark:text-white"><?php echo e($totalProducts); ?></div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                <h2 class="text-lg font-black text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Recent Orders
                </h2>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-xs font-bold text-primary hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-[10px] font-black uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800">
                        <tr>
                            <th class="p-6">Order ID</th>
                            <th class="p-6">Customer</th>
                            <th class="p-6">Status</th>
                            <th class="p-6">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="p-6 font-bold text-slate-900 dark:text-white text-sm">#<?php echo e($o->order_number); ?></td>
                                <td class="p-6">
                                    <div class="text-sm font-bold"><?php echo e($o->customer_name); ?></div>
                                    <div class="text-[10px] text-slate-400 font-medium"><?php echo e($o->customer_email); ?></div>
                                </td>
                                <td class="p-6">
                                    <span class="px-2 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                                        <?php echo e($o->status); ?>

                                    </span>
                                </td>
                                <td class="p-6 font-black text-slate-900 dark:text-white text-sm">$<?php echo e($o->total); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none h-80 flex flex-col items-center justify-center text-center">
            <div class="h-16 w-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-3xl">analytics</span>
            </div>
            <h3 class="font-black text-xl mb-2">Sales Analytics</h3>
            <p class="text-slate-400 text-sm max-w-xs">Integrating real-time charts using Chart.js to visualize your weekly performance.</p>
        </div>
    </div>

    
    <div class="space-y-6">
        
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 bg-red-50/50 dark:bg-red-900/10">
                <h2 class="text-sm font-black text-red-600 flex items-center gap-2 uppercase tracking-widest">
                    <span class="material-symbols-outlined text-xl">warning</span>
                    Low Stock Alerts
                </h2>
            </div>
            <div class="p-2">
                <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        <div class="h-10 w-10 rounded-xl overflow-hidden shadow-sm">
                            <img class="h-full w-full object-cover" src="<?php echo e($p->images->first()->url ?? 'https://placehold.co/100x100'); ?>" alt="">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold truncate"><?php echo e($p->name); ?></div>
                            <div class="text-[10px] font-black text-red-500 uppercase tracking-widest mt-1"><?php echo e($p->stock); ?> Left</div>
                        </div>
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="p-8 text-center text-slate-400 text-xs italic">All stock levels are healthy!</div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-primary p-8 rounded-3xl shadow-xl shadow-primary/30 text-white relative overflow-hidden group">
            <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-9xl text-white/10 group-hover:scale-125 transition-transform duration-700">rocket_launch</span>
            <h2 class="text-xl font-black mb-4 relative z-10">Market Your Store</h2>
            <p class="text-sm text-white/80 mb-6 font-medium relative z-10 leading-relaxed">Create new discount coupons or start a marketing campaign to boost sales.</p>
            <button class="w-full py-3.5 bg-white text-primary font-black rounded-2xl shadow-lg hover:scale-[1.02] active:scale-95 transition-all relative z-10">
                Create Coupon
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>