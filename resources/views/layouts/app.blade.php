<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mobileMenuOpen: false }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Employee Web App') }}</title>

    <!-- Scripts & Fonts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                    }
                },
            },
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        [x-cloak] {
            display: none !important;
        }

        .nav-link-active {
            background-color: rgba(79, 70, 229, 0.08);
            color: #3525cd;
            border-left: 4px solid #3525cd;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .nav-link-inactive {
            color: #464555;
            border-left: 4px solid transparent;
        }

        .nav-link-inactive:hover {
            background-color: #eff4ff;
            color: #0b1c30;
        }
    </style>
</head>

<body class="text-on-surface antialiased">

    <!-- Mobile Top Bar -->
    <div
        class="lg:hidden flex items-center justify-between bg-surface-container-lowest px-4 py-3 border-b border-outline-variant/30 sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary-container rounded-lg flex items-center justify-center shadow-md">
                <span class="material-symbols-outlined text-white text-[20px]">badge</span>
            </div>
            <span class="font-bold text-on-surface tracking-tight text-sm">Employee Web App</span>
        </div>
        <button @click="mobileMenuOpen = true" class="p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-surface-container-lowest border-r border-outline-variant/30 transition-transform duration-300 ease-in-out lg:sticky lg:top-0 lg:h-screen lg:block">
            <div class="flex flex-col h-full">

                <div class="p-6 flex items-center gap-3 shrink-0">
                    <div
                        class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-white text-[24px]">badge</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-base leading-none tracking-tight text-on-surface">Employee Web
                            App</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="lg:hidden ml-auto">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div class="px-6 mb-4 shrink-0">
                    <div class="bg-surface-container-low rounded-2xl p-4 border border-outline-variant/10">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div
                                    class="w-11 h-11 rounded-full bg-indigo-100 border-2 border-white overflow-hidden shadow-sm text-center flex items-center justify-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&color=7F9CF5&background=EBF4FF"
                                        alt="Profile">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span
                                    class="font-bold text-sm truncate text-on-surface">{{ auth()->user()->employee->name ?? 'Administrator' }}</span>
                                <span class="text-[10px] text-on-surface-variant uppercase font-bold opacity-60">{{ auth()->user()->employee->department ?? 'Administrator' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 px-4 space-y-1 overflow-y-auto scrollbar-hide">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-r-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link-inactive' }}">
                        <span
                            class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'fill-1' : '' }}">grid_view</span>
                        <span class="font-semibold text-sm">Dashboard</span>
                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-r-xl transition-all duration-200 group {{ request()->routeIs('employees.*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                        <span
                            class="material-symbols-outlined {{ request()->routeIs('employees.*') ? 'fill-1' : '' }}">groups</span>
                        <span class="font-semibold text-sm">Employee Directory</span>
                    </a>
                </nav>

                <div class="p-6 mt-auto border-t border-outline-variant/10 bg-surface-container-low/30 shrink-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white text-on-surface-variant hover:text-red-600 hover:bg-red-50 hover:border-red-100 border border-outline-variant/30 transition-all duration-200 group shadow-sm">
                            <span
                                class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">logout</span>
                            <span class="font-bold text-sm">Sign Out</span>
                        </button>
                    </form>
                </div>

            </div>
        </aside>

        <!-- Overlay for mobile menu -->
        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" x-cloak
            class="fixed inset-0 bg-on-surface/20 backdrop-blur-sm z-40 lg:hidden"
            x-transition:enter="transition opacity-100" x-transition:leave="transition opacity-0"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Header Area -->
            @if (isset($header))
                <header
                    class="bg-surface/80 backdrop-blur-md sticky top-0 z-30 px-6 py-6 lg:px-10 border-b border-outline-variant/10">
                    <div class="max-w-7xl mx-auto flex items-center justify-between">
                        <div class="font-headline-sm text-headline-sm">
                            {{ $header }}
                        </div>
                        <div
                            class="hidden sm:block text-[10px] font-mono uppercase tracking-widest text-on-surface-variant/40">
                            {{ date('l, jS F Y') }}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Content Slot -->
            <main class="p-6 lg:p-10 flex-1 animate-in fade-in slide-in-from-bottom-2 duration-500">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer
                class="px-10 py-6 border-t border-outline-variant/10 flex justify-between items-center bg-surface-container-low/20">
                <div class="text-[10px] text-on-surface-variant/30 font-medium">
                    &copy; {{ date('Y') }} Employee Web App
                </div>
            </footer>
        </div>
    </div>

</body>

</html>