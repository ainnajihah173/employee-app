<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts & Fonts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.4.2/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#f8f9ff",
                        "primary-container": "#4f46e5",
                        "primary": "#3525cd",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#464555",
                        "outline-variant": "#c7c4d8",
                        "surface-bright": "#f8f9ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        "surface-dim": "#cbdbf5",
                        "on-primary": "#ffffff",
                    },
                    fontSize: {
                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    }
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .input-focus-ring:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-surface min-h-screen flex items-center justify-center p-6 overflow-hidden relative">
    
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="blob absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-primary/5 blur-[120px]"></div>
        <div class="blob absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-200/20 blur-[120px]"></div>
    </div>

    <!-- Main Content Slot -->
    <main class="w-full max-w-[440px] relative z-10">
        {{ $slot }}
    </main>

    <script>
        // Interactive Parallax Effect
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            const blobs = document.querySelectorAll('.blob');
            blobs.forEach((blob, index) => {
                const speed = (index + 1) * 30;
                blob.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });
    </script>
</body>
</html>