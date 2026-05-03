<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - <?php echo e($order->order_number); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .invoice-card { border: none; shadow: none; }
        }
    </style>
</head>
<body class="bg-slate-50 p-4 md:p-10">

    <div class="max-w-4xl mx-auto no-print mb-8 flex justify-between items-center">
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-slate-500 font-bold hover:text-slate-900 flex items-center gap-2">
            ← Back to Orders
        </a>
        <button onclick="window.print()" class="bg-slate-900 text-white px-8 py-3 rounded-2xl font-black shadow-xl hover:scale-105 transition-all">
            Print / Download PDF
        </button>
    </div>

    <div class="max-w-4xl mx-auto bg-white border border-slate-200 shadow-2xl rounded-[2.5rem] overflow-hidden invoice-card">
        
        <div class="p-12 bg-slate-900 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div>
                <div class="text-4xl font-black tracking-tighter mb-2">ShopModern</div>
                <div class="text-slate-400 font-bold uppercase tracking-widest text-xs">Official Sales Receipt</div>
            </div>
            <div class="text-right">
                <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Invoice Number</div>
                <div class="text-2xl font-black"><?php echo e($order->order_number); ?></div>
            </div>
        </div>

        <div class="p-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Billed To</h4>
                    <div class="text-xl font-black text-slate-900 mb-1"><?php echo e($order->customer_name); ?></div>
                    <div class="text-slate-500 font-medium mb-1"><?php echo e($order->customer_email); ?></div>
                    <?php if($order->customer_phone): ?>
                        <div class="text-slate-500 font-medium mb-4"><?php echo e($order->customer_phone); ?></div>
                    <?php endif; ?>
                    <div class="text-sm text-slate-400 font-bold uppercase tracking-tight">Shipping Address:</div>
                    <div class="text-slate-600 font-medium leading-relaxed"><?php echo e($order->shipping_address ?? 'Standard Shipping'); ?></div>
                </div>
                <div class="md:text-right">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Order Summary</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between md:justify-end gap-8">
                            <span class="text-slate-400 font-bold text-sm">Issue Date:</span>
                            <span class="text-slate-900 font-black text-sm"><?php echo e($order->created_at->format('M d, Y')); ?></span>
                        </div>
                        <div class="flex justify-between md:justify-end gap-8">
                            <span class="text-slate-400 font-bold text-sm">Payment State:</span>
                            <span class="text-emerald-600 font-black text-sm uppercase tracking-widest"><?php echo e($order->payment_status); ?></span>
                        </div>
                        <div class="flex justify-between md:justify-end gap-8">
                            <span class="text-slate-400 font-bold text-sm">Delivery:</span>
                            <span class="text-primary font-black text-sm uppercase tracking-widest"><?php echo e($order->status); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            
            <table class="w-full mb-12">
                <thead>
                    <tr class="border-b-2 border-slate-900 text-left">
                        <th class="py-4 text-xs font-black uppercase tracking-widest text-slate-400">Description</th>
                        <th class="py-4 text-center text-xs font-black uppercase tracking-widest text-slate-400">Qty</th>
                        <th class="py-4 text-right text-xs font-black uppercase tracking-widest text-slate-400">Price</th>
                        <th class="py-4 text-right text-xs font-black uppercase tracking-widest text-slate-400">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="py-6">
                                <div class="font-black text-slate-900"><?php echo e($item->product->name); ?></div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase mt-1">
                                    Size: <?php echo e($item->size ?? 'N/A'); ?> | Color: <?php echo e($item->color ?? 'N/A'); ?>

                                </div>
                            </td>
                            <td class="py-6 text-center font-bold text-slate-600">x<?php echo e($item->quantity); ?></td>
                            <td class="py-6 text-right font-bold text-slate-600">$<?php echo e(number_format($item->price_cents / 100, 2)); ?></td>
                            <td class="py-6 text-right font-black text-slate-900">$<?php echo e(number_format(($item->price_cents * $item->quantity) / 100, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            
            <div class="flex justify-end pt-12 border-t-2 border-slate-100">
                <div class="w-full max-w-xs space-y-4">
                    <div class="flex justify-between">
                        <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Subtotal</span>
                        <span class="text-slate-900 font-bold">$<?php echo e(number_format($order->subtotal_cents / 100, 2)); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Shipping</span>
                        <span class="text-slate-900 font-bold">$<?php echo e(number_format($order->shipping_cents / 100, 2)); ?></span>
                    </div>
                    <div class="flex justify-between pt-4 border-t border-slate-100">
                        <span class="text-slate-900 font-black uppercase tracking-widest">Total Pay</span>
                        <span class="text-3xl font-black text-primary">$<?php echo e($order->total); ?></span>
                    </div>
                </div>
            </div>

            
            <div class="mt-20 pt-12 border-t border-slate-100 text-center">
                <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-4">Terms & Conditions</div>
                <p class="max-w-md mx-auto text-slate-400 text-[10px] leading-relaxed">Thank you for shopping with ShopModern. Please keep this invoice for your records. For returns or support, contact help@shopmodern.com within 30 days.</p>
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/orders/invoice.blade.php ENDPATH**/ ?>