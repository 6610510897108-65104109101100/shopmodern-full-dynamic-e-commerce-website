<?php $__env->startSection('title', 'Generate Coupon — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Generate Coupon</h1>
        <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Configure new discount incentive</p>
    </div>
    <a href="<?php echo e(route('admin.coupons.index')); ?>" class="px-6 py-3 bg-slate-200 text-black font-bold rounded-2xl hover:bg-slate-300 transition-all flex items-center gap-2">
        <span class="material-symbols-outlined">arrow_back</span>
        Back to List
    </a>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm p-8">
    <form action="<?php echo e(route('admin.coupons.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Coupon Identity (Code)</label>
                <input type="text" name="code" value="<?php echo e(old('code')); ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-mono">
                <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Yield Type</label>
                <select name="type" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <option value="fixed" <?php echo e(old('type') == 'fixed' ? 'selected' : ''); ?>>Currency Units (Fixed)</option>
                    <option value="percent" <?php echo e(old('type') == 'percent' ? 'selected' : ''); ?>>Percentage (%)</option>
                </select>
                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Value</label>
                <input type="number" step="0.01" name="value" value="<?php echo e(old('value')); ?>" required min="0" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Utilization Capacity (Max Uses)</label>
                <input type="number" name="max_uses" value="<?php echo e(old('max_uses')); ?>" min="1" placeholder="Leave empty for infinite" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                <?php $__errorArgs = ['max_uses'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Starts At</label>
                <input type="datetime-local" name="starts_at" value="<?php echo e(old('starts_at')); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                <?php $__errorArgs = ['starts_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Expires At</label>
                <input type="datetime-local" name="expires_at" value="<?php echo e(old('expires_at')); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                <?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="md:col-span-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?> class="w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Activate Immediately</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-8 py-4 bg-primary text-white font-black uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform">
                Forge Coupon
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/coupons/create.blade.php ENDPATH**/ ?>