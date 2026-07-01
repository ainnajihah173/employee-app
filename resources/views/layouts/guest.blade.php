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
                        "success": "#059669",
                    },
                    fontSize: {
                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "label-lg": ["16px", {"lineHeight": "24px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "body-xs": ["12px", {"lineHeight": "16px", "fontWeight": "400"}],
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
        
        /* Smooth Transitions */
        * { transition-property: color, background-color, border-color, box-shadow; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }
        button, a, input[type="checkbox"] { transition-duration: 150ms; }
        
        /* Blob Animation */
        @keyframes blob-move {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .blob {
            animation: blob-move 7s infinite;
        }
    </style>
</head>
<body class="bg-surface min-h-screen flex flex-col lg:flex-row overflow-x-hidden relative">
    
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="blob absolute top-[-10%] left-[-5%] w-[500px] h-[500px] rounded-full bg-primary/10 blur-[120px] opacity-60"></div>
        <div class="blob absolute bottom-[-15%] right-[-5%] w-[500px] h-[500px] rounded-full bg-indigo-200/20 blur-[120px] opacity-60"></div>
        <div class="blob absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full bg-blue-100/10 blur-[120px] opacity-40"></div>
    </div>

    <!-- Main Content Slot - Responsive -->
    <main class="w-full flex-1 relative z-10">
        {{ $slot }}
    </main>

    <script>
        // Interactive Parallax Effect - Smooth & Optimized
        let animationFrameId = null;
        document.addEventListener('mousemove', (e) => {
            if (animationFrameId) cancelAnimationFrame(animationFrameId);
            
            animationFrameId = requestAnimationFrame(() => {
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                const blobs = document.querySelectorAll('.blob');
                
                blobs.forEach((blob, index) => {
                    const speed = (index + 1) * 15;
                    blob.style.willChange = 'transform';
                    blob.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
                });
            });
        });

        // Reset on mouse leave
        document.addEventListener('mouseleave', () => {
            const blobs = document.querySelectorAll('.blob');
            blobs.forEach(blob => {
                blob.style.transform = 'translate(0, 0)';
                blob.style.willChange = 'auto';
            });
        });
    </script>
</body>
</html>