<x-guest-layout>
    <!-- Branding -->
    <div class="flex flex-col items-center mb-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="w-12 h-12 bg-primary-container rounded-xl flex items-center justify-center mb-4 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-white text-[28px]">corporate_fare</span>
        </div>
        <h1 class="text-headline-md text-on-surface">Employee Web App</h1>
        <p class="text-body-sm text-on-surface-variant mt-1">Employee Management</p>
    </div>

    <!-- Login Card -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-8 shadow-xl shadow-surface-dim/20">
        <header class="mb-6">
            <h2 class="text-headline-sm text-on-surface">Welcome back</h2>
            <p class="text-body-sm text-on-surface-variant">Please enter your credentials to continue.</p>
        </header>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
            @csrf

            <!-- Email Field -->
            <div class="space-y-2">
                <label class="block text-label-md text-on-surface" for="email">Email</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[20px] group-focus-within:text-primary transition-colors">mail</span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-4 py-3 bg-surface-bright border border-outline-variant rounded-xl text-body-md text-on-surface input-focus-ring transition-all duration-200"
                        placeholder="name@company.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password Field -->
            <div class="space-y-2" x-data="{ show: false }">
                <div class="flex justify-between items-center">
                    <label class="block text-label-md text-on-surface" for="password">Password</label>
                    <a class="text-label-sm text-primary hover:underline transition-all" href="{{ route('password.request') }}">Forgot?</a>
                </div>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[20px] group-focus-within:text-primary transition-colors">lock</span>
                    <input id="password" :type="show ? 'text' : 'password'" name="password" required
                        class="w-full pl-10 pr-12 py-3 bg-surface-bright border border-outline-variant rounded-xl text-body-md text-on-surface input-focus-ring transition-all duration-200"
                        placeholder="••••••••">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-primary border-outline-variant rounded focus:ring-primary/20 transition-all cursor-pointer">
                <label for="remember_me" class="ml-2 text-body-sm text-on-surface-variant cursor-pointer select-none">Remember this device</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" 
                class="w-full bg-primary-container text-on-primary text-label-md py-4 rounded-xl shadow-md shadow-primary/10 hover:bg-primary transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-2 group">
                <span id="btnText">Sign In</span>
                <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant/20 text-center">
            <p class="text-body-sm text-on-surface-variant">
                Don't have an account yet? 
                <a class="text-primary font-semibold hover:underline" href="#">Contact IT Support</a>
            </p>
        </div>
    </div>

    <script>
        // Form Loading Animation
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('btnText');
            btn.classList.add('opacity-80', 'cursor-not-allowed');
            text.innerText = 'Authenticating...';
        });
    </script>
</x-guest-layout>