<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Total Employees Card -->
            <div class="bg-white p-8 rounded-[2rem] border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-xl hover:shadow-indigo-100 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-[28px]">groups</span>
                    </div>
                    <p class="text-sm font-bold text-on-surface-variant/60 uppercase tracking-widest">Total Personnel</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-4xl font-black text-on-surface tracking-tighter">{{ $totalEmployees ?? 0 }}</h3>
                        <span class="text-on-surface-variant/40 text-xs font-medium mb-1.5 uppercase tracking-widest">Users</span>
                    </div>
                </div>
            </div>

            <!-- Departments Card -->
            <div class="bg-white p-8 rounded-[2rem] border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-xl hover:shadow-purple-100 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-4">
                        <span class="material-symbols-outlined text-[28px]">hub</span>
                    </div>
                    <p class="text-sm font-bold text-on-surface-variant/60 uppercase tracking-widest">Active Units</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-4xl font-black text-on-surface tracking-tighter">{{ $departmentStats->count() ?? 0 }}</h3>
                        <span class="text-on-surface-variant/40 text-xs font-medium mb-1.5 uppercase tracking-widest">Departments</span>
                    </div>
                </div>
            </div>

            <!-- Quick Action Card -->
            @if(auth()->user()->role === 'hr_admin')
            <div class="bg-indigo-700 p-8 rounded-[2rem] shadow-xl shadow-indigo-200 relative overflow-hidden group flex flex-col justify-between">

                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                
                <div class="relative z-10">
                    <h4 class="text-white font-bold text-lg leading-tight">Need to onboard someone new?</h4>
                    <p class="text-indigo-100 text-xs mt-2 opacity-80 leading-relaxed">Quickly create a system profile and generate temporary credentials.</p>
                </div>

                <div class="relative z-10 mt-6">
                    <a href="{{ route('employees.create') }}" class="inline-flex items-center gap-2 w-full bg-white text-indigo-700 font-bold py-3.5 px-4 rounded-2xl text-center justify-center transition-all hover:bg-indigo-50 active:scale-95 shadow-lg shadow-indigo-900/20">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        Add New Employee
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Recent Hires List -->
            <div class="lg:col-span-2 bg-white rounded-[2rem] border border-outline-variant/30 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-on-surface">Recent Hires</h3>
                        <p class="text-xs text-on-surface-variant">Last 5 employees onboarded to the system</p>
                    </div>
                    <a href="{{ route('employees.index') }}" class="text-xs font-bold text-primary hover:underline uppercase tracking-widest">View All</a>
                </div>
                
                <div class="divide-y divide-outline-variant/10">
                    @forelse($recentHires ?? [] as $hire)
                        <div class="px-8 py-5 flex items-center justify-between hover:bg-surface/50 transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center overflow-hidden shrink-0 group-hover:scale-110 transition-transform">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($hire->name) }}&background=EEF2FF&color=4F46E5" alt="">
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-sm font-bold text-on-surface">{{ $hire->name }}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-tighter">{{ $hire->department }}</span>
                                        <span class="w-1 h-1 rounded-full bg-outline-variant/50"></span>
                                        <span class="text-[10px] text-on-surface-variant/40">{{ $hire->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('employees.show', $hire) }}" class="p-2 bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-primary/10 hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                            </a>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <span class="material-symbols-outlined text-outline-variant/30 text-[48px] mb-2">person_off</span>
                            <p class="text-sm text-on-surface-variant">No recent employee records found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Department Distribution -->
            <div class="bg-white rounded-[2rem] border border-outline-variant/30 shadow-sm p-8">
                <h3 class="font-bold text-on-surface mb-6">Unit Distribution</h3>
                <div class="space-y-6">
                    @foreach($departmentStats->take(5) as $stat)
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-xs">
                                <span class="font-bold text-on-surface">{{ $stat->department }}</span>
                                <span class="text-on-surface-variant font-mono">{{ $stat->total }}</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                @php
                                    $percentage = ($totalEmployees > 0) ? ($stat->total / $totalEmployees) * 100 : 0;
                                @endphp
                                <div class="h-full bg-primary rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>