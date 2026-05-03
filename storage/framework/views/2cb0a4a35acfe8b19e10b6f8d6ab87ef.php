<?php $__env->startSection('title', 'Site Settings — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <h1 class="text-3xl font-black tracking-tighter text-slate-900 uppercase italic">Site Settings</h1>
    <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mt-1">Configure global application parameters</p>
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm p-8 max-w-4xl">
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?php echo csrf_field(); ?>

        
        <div>
            <h3 class="text-xl font-black tracking-tight text-slate-900 mb-6 uppercase">Homepage Hero Banner</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Background Image</label>
                    <?php if(isset($settings['hero_image'])): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(asset($settings['hero_image'])); ?>" alt="Current Hero Image" class="w-full max-w-md h-auto rounded-xl object-cover shadow-sm">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="hero_image" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <p class="text-xs text-slate-400 mt-2">Recommended size: 1920x1080px. Leave empty to keep current.</p>
                    <?php $__errorArgs = ['hero_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Main Title</label>
                    <input type="text" name="hero_title" value="<?php echo e(old('hero_title', $settings['hero_title'] ?? 'NEW SEASON')); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-display">
                    <?php $__errorArgs = ['hero_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Subtitle</label>
                    <input type="text" name="hero_subtitle" value="<?php echo e(old('hero_subtitle', $settings['hero_subtitle'] ?? 'Autumn / Winter Collectio 2026')); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <?php $__errorArgs = ['hero_subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Button Text</label>
                    <input type="text" name="hero_button_text" value="<?php echo e(old('hero_button_text', $settings['hero_button_text'] ?? 'Shop Collection')); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <?php $__errorArgs = ['hero_button_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Button Link URL</label>
                    <input type="text" name="hero_button_link" value="<?php echo e(old('hero_button_link', $settings['hero_button_link'] ?? route('shop'))); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary transition-all font-mono">
                    <?php $__errorArgs = ['hero_button_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-8 py-4 bg-primary text-white font-black uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform">
                Save Configurations
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>