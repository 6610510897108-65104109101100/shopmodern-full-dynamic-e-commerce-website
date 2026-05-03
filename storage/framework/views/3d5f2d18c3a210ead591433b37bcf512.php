<?php $__env->startSection('title', 'Sales & Revenue Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Revenue Intelligence</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-sm italic">Analyze financial performance and payment history</p>
    </div>

    <form method="GET" action="<?php echo e(route('admin.reports.index')); ?>" class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2 bg-white dark:bg-slate-900 px-4 py-2 rounded-2xl ring-1 ring-slate-200 dark:ring-slate-800 shadow-sm">
            <span class="material-symbols-outlined text-slate-400 text-sm">calendar_today</span>
            <input type="date" name="start_date" value="<?php echo e($startDate); ?>" class="bg-transparent border-none text-xs font-bold focus:ring-0 p-0 w-32">
            <span class="text-slate-300 font-bold">to</span>
            <input type="date" name="end_date" value="<?php echo e($endDate); ?>" class="bg-transparent border-none text-xs font-bold focus:ring-0 p-0 w-32">
        </div>
        
        <button class="px-6 py-3.5 rounded-2xl bg-primary text-white font-black shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-xl">analytics</span>
            <span>Update Report</span>
        </button>
    </form>
</div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="h-12 w-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <span class="text-slate-400 text-sm font-black uppercase tracking-widest">Total Revenue</span>
        </div>
        <div class="text-4xl font-black text-slate-900 dark:text-white">$<?php echo e(number_format($summary->total_revenue / 100, 2)); ?></div>
        <p class="text-emerald-500 text-xs font-bold mt-2">Successful Transactions</p>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-all"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="h-12 w-12 rounded-2xl bg-primary text-white flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined">shopping_cart_checkout</span>
            </div>
            <span class="text-slate-400 text-sm font-black uppercase tracking-widest">Orders Count</span>
        </div>
        <div class="text-4xl font-black text-slate-900 dark:text-white"><?php echo e($summary->total_orders); ?></div>
        <p class="text-primary text-xs font-bold mt-2">Paid Orders Processed</p>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-all"></div>
        <div class="flex items-center gap-4 mb-4">
            <div class="h-12 w-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-500/20">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <span class="text-slate-400 text-sm font-black uppercase tracking-widest">Avg. Ticket</span>
        </div>
        <div class="text-4xl font-black text-slate-900 dark:text-white">$<?php echo e(number_format($summary->avg_order_value / 100, 2)); ?></div>
        <p class="text-amber-500 text-xs font-bold mt-2">Revenue Per Order</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-8">
        <h3 class="text-lg font-black text-slate-900 dark:text-white mb-8 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">show_chart</span>
            Revenue Trend Analysis
        </h3>
        <canvas id="revenueChart" height="280"></canvas>
    </div>

    
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl flex flex-col">
        <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Recent Payments</h3>
            <span class="material-symbols-outlined text-emerald-500">verified</span>
        </div>
        
        <div class="p-8 space-y-6 flex-1 overflow-y-auto max-h-[400px]">
            <?php $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black">
                            <span class="material-symbols-outlined">add</span>
                        </div>
                        <div>
                            <div class="text-sm font-black text-slate-900 dark:text-white"><?php echo e($p->order_number); ?></div>
                            <div class="text-[10px] font-bold text-slate-400 capitalize"><?php echo e($p->created_at->diffForHumans()); ?></div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-emerald-600">+$<?php echo e($order->total); ?></div>
                        <div class="text-[9px] text-slate-400 font-bold uppercase"><?php echo e($p->customer_name); ?></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-b-3xl">
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'paid'])); ?>" class="w-full flex items-center justify-center gap-2 text-xs font-black text-primary uppercase tracking-widest hover:underline transition-all">
                View All Transactions
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chartData = <?php echo json_encode($dailyRevenue); ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(d => d.date),
            datasets: [{
                label: 'Revenue ($)',
                data: chartData.map(d => d.revenue),
                borderColor: '#137fec',
                backgroundColor: 'rgba(19, 127, 236, 0.1)',
                borderWidth: 4,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#137fec',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { weight: 'bold' } } },
                x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>