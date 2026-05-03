<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'ShopModern')</title>

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
    @include('public.partials.header')

    <main class="flex-1 w-full max-w-[1280px] mx-auto px-6 md:px-10 py-8">
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-800">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @include('public.partials.footer')
</div>
</body>
</html>