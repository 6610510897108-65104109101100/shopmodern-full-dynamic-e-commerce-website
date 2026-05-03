<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo $__env->yieldContent('title', 'ShopModern'); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { 
                        primary: "#111111", 
                        accent: "#137fec",
                        "background-light": "#ffffff", 
                        "background-dark": "#0a0a0a" 
                    },
                    fontFamily: { 
                        display: ["Outfit", "Plus Jakarta Sans"],
                        sans: ["Plus Jakarta Sans"]
                    },
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 24; }
        body { font-family: "Plus Jakarta Sans", sans-serif; letter-spacing: -0.01em; }
        .font-display { font-family: "Outfit", sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display:none; }
        .scrollbar-hide { -ms-overflow-style:none; scrollbar-width:none; }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #1e293b; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-50 transition-colors duration-200">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <?php echo $__env->make('public.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-1 w-full max-w-[1280px] mx-auto px-6 md:px-10 py-8">
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 font-semibold">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-800">
                <ul class="list-disc ml-6">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($e); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('public.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
</body>
</html><?php /**PATH C:\xampp3\htdocs\ShopModern\shopmodern\shopmodern\resources\views/layouts/public.blade.php ENDPATH**/ ?>