<?php $__env->startSection('title', 'Refine Collection — ShopModern'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <div class="flex items-center gap-4 mb-2">
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white uppercase italic">Refine Collection</h1>
    </div>
    <p class="text-slate-500 dark:text-slate-400 font-medium text-sm italic ml-14">Updating: <?php echo e($category->name); ?></p>
</div>

<form method="POST" action="<?php echo e(route('admin.categories.update', $category)); ?>" enctype="multipart/form-data" 
      class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none p-8 lg:p-12 mb-20 overflow-hidden relative">
    
    <div class="absolute top-0 right-0 p-12 opacity-5 dark:opacity-10 pointer-events-none">
        <span class="material-symbols-outlined text-[10rem]">auto_fix_high</span>
    </div>

    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10">
        
        <div class="space-y-8">
            <div class="border-l-4 border-primary pl-4 mb-8">
                 <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase">Visual Identity</h2>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-4 ml-1">Collection Cover Image</label>
                <div class="relative group aspect-[4/5] rounded-[2.5rem] bg-slate-50 dark:bg-slate-800 border-2 border-dashed border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col items-center justify-center transition-all hover:border-primary cursor-pointer">
                    <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(event)">
                    
                    <div id="image-placeholder" class="text-center group-hover:-translate-y-2 transition-transform <?php echo e($category->image ? 'opacity-0' : ''); ?>">
                        <span class="material-symbols-outlined text-5xl text-slate-300 group-hover:text-primary transition-colors">add_photo_alternate</span>
                        <p class="text-[10px] font-black text-slate-400 mt-4 uppercase tracking-widest leading-relaxed">Touch to Replace</p>
                    </div>

                    <img id="image-preview" src="<?php echo e($category->image_url); ?>" class="absolute inset-0 w-full h-full object-cover pointer-events-none">
                    
                    <button type="button" onclick="resetPreview(event)" id="reset-btn" class="absolute top-6 right-6 p-2 rounded-full bg-white/90 backdrop-blur text-red-500 shadow-lg opacity-0 pointer-events-none transition-opacity z-30">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
                <p class="text-[9px] text-slate-400 mt-4 font-bold uppercase tracking-widest italic text-center">Collection images should mirror the brand aesthetic (Portrait 4:5)</p>
            </div>
        </div>

        
        <div class="space-y-8">
            <div class="border-l-4 border-amber-400 pl-4 mb-8">
                 <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase">Contextual Data</h2>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Collection Name</label>
                <div class="relative group font-display">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">label</span>
                    <input name="name" value="<?php echo e(old('name', $category->name)); ?>" placeholder="e.g. Minimalist Essentials" class="w-full pl-12 pr-4 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-amber-400 transition-all font-black text-xl tracking-tight" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Editorial Vision (Description)</label>
                <textarea name="description" rows="6" placeholder="Describe the mood, aesthetic, and purpose of this collection..." class="w-full px-5 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-none ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-amber-400 transition-all font-medium text-slate-700 dark:text-slate-300 italic min-h-[160px]"><?php echo e(old('description', $category->description)); ?></textarea>
            </div>

            <div class="pt-8">
                <button class="w-full py-6 rounded-[2rem] bg-black text-white font-black text-xs uppercase tracking-[0.3em] shadow-2xl hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-4">
                    <span class="material-symbols-outlined text-sm">auto_fix_high</span>
                    Update Narrative
                </button>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('image-preview');
        output.src = reader.result;
        output.classList.remove('hidden');
        document.getElementById('image-placeholder').classList.add('opacity-0');
    };
    reader.readAsDataURL(event.target.files[0]);
}

function resetPreview(event) {
    event.preventDefault();
    const input = document.querySelector('input[type="file"]');
    input.value = '';
    const output = document.getElementById('image-preview');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>