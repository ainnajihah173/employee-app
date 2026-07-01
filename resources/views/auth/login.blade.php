<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- LEFT SIDE - Demo Credentials (Visible on Desktop) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-50 to-blue-50 p-8 flex-col justify-center">
            <div class="max-w-sm mx-auto w-full space-y-6">
                <!-- Header -->
                <div class="space-y-2">
                    <h2 class="text-2xl font-bold text-slate-800">Test Accounts</h2>
                    <p class="text-sm text-slate-600">Use these credentials to explore the system</p>
                </div>

                <!-- Admin Card -->
                <div class="bg-white border-2 border-indigo-200 rounded-xl p-5 hover:shadow-lg hover:border-indigo-400 transition-all cursor-pointer group"
                    onclick="document.getElementById('email').value='siti.nurul@company.com'; document.getElementById('password').value='password'; document.getElementById('email').focus();">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-indigo-600 text-[20px]">admin_panel_settings</span>
                        <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider">HR Admin</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-indigo-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Email</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">siti.nurul@company.com</p>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-indigo-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Password</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">password</p>
                        </div>
                    </div>
                    <p class="text-xs text-indigo-600 mt-3 font-semibold">✓ Can add, edit & delete employees</p>
                    <p class="text-[10px] text-slate-400 mt-2">Click to auto-fill →</p>
                </div>

                <!-- Employee Card 1 -->
                <div class="bg-white border-2 border-emerald-200 rounded-xl p-5 hover:shadow-lg hover:border-emerald-400 transition-all cursor-pointer group"
                    onclick="document.getElementById('email').value='ahmad.hassan@company.com'; document.getElementById('password').value='password'; document.getElementById('email').focus();">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">person</span>
                        <h3 class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Employee</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-emerald-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Email</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">ahmad.hassan@company.com</p>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-emerald-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Password</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">password</p>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-600 mt-3 font-semibold">✓ View only access</p>
                    <p class="text-[10px] text-slate-400 mt-2">Click to auto-fill →</p>
                </div>

                <!-- Employee Card 2 -->
                <div class="bg-white border-2 border-emerald-200 rounded-xl p-5 hover:shadow-lg hover:border-emerald-400 transition-all cursor-pointer group"
                    onclick="document.getElementById('email').value='divya.nair@company.com'; document.getElementById('password').value='password'; document.getElementById('email').focus();">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">person</span>
                        <h3 class="text-xs font-bold text-emerald-600 uppercase tracking-wider">HR Employee </h3>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-emerald-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Email</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">divya.nair@company.com</p>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-emerald-50 transition-all">
                            <p class="text-[10px] text-slate-400 mb-1">Password</p>
                            <p class="text-sm font-mono font-semibold text-slate-800">password</p>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-600 mt-3 font-semibold">✓ View only access</p>
                    <p class="text-[10px] text-slate-400 mt-2">Click to auto-fill →</p>
                </div>

            </div>
        </div>

        <!-- RIGHT SIDE - Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-4 py-8 lg:py-0">
            <div class="w-full max-w-md space-y-6">
                <!-- Branding -->
                <div class="text-center space-y-2">
                    <div class="inline-block p-3 bg-indigo-100 rounded-lg mb-2">
                        <span class="material-symbols-outlined text-indigo-600 text-[32px]">corporate_fare</span>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900">Employee Web App</h1>
                    <p class="text-sm text-slate-500">Employee Management System</p>
                </div>

                <!-- Login Card -->
                <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
                    <header class="mb-6">
                        <h2 class="text-lg font-bold text-slate-800">Welcome back</h2>
                        <p class="text-sm text-slate-500">Enter your account details to continue.</p>
                    </header>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
                        @csrf

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide" for="email">Work Email</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px] group-focus-within:text-indigo-600 transition-colors">mail</span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                    placeholder="name@company.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-1" x-data="{ show: false }">
                            <div class="flex justify-between items-center">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide" for="password">Password</label>
                                <a class="text-xs font-semibold text-indigo-600 hover:text-indigo-800" href="{{ route('password.request') }}">Forgot?</a>
                            </div>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px] group-focus-within:text-indigo-600 transition-colors">lock</span>
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                                    class="w-full pl-10 pr-12 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                            <label for="remember_me" class="ml-2 text-sm text-slate-600 cursor-pointer select-none">Remember this device</label>
                        </div>

                        <button type="submit" id="submitBtn"
                            class="w-full bg-indigo-600 text-white text-sm font-bold py-3 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm flex items-center justify-center gap-2 group">
                            <span id="btnText">Sign In</span>
                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                        </button>
                    </form>

                    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                        <p class="text-xs text-slate-400">
                            © {{ date('Y') }} Employee Web App
                        </p>
                    </div>
                </div>

                <!-- Mobile Demo Info -->
                <div class="lg:hidden bg-indigo-50 border border-indigo-200 rounded-xl p-4">
                    <p class="text-xs text-indigo-700 font-semibold mb-2">📱 Demo Credentials</p>
                    <div class="space-y-2 text-[11px]">
                        <div class="bg-white p-2 rounded">
                            <p class="font-mono text-slate-700">HR Admin: siti.nurul@company.com</p>
                        </div>
                        <div class="bg-white p-2 rounded">
                            <p class="font-mono text-slate-700">Employee: ahmad.hassan@company.com</p>
                        </div>
                        <div class="bg-white p-2 rounded">
                            <p class="font-mono text-slate-700">HR Employee: divya.nair@company.com</p>
                        </div>
                        <p class="text-center text-indigo-600 font-semibold">Password: password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('btnText');
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            text.innerText = 'Authenticating...';
        });
    </script>
</x-guest-layout>