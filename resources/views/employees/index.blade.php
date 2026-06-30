<x-app-layout>
    <!-- Alpine Data for Modal -->
    <div x-data="{ 
        deleteModalOpen: false, 
        employeeName: '', 
        deleteRoute: '' 
    }">

        <x-slot name="header">
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Directory') }}
        </h2>
        </x-slot>

        <div>
            
            <!-- Success Notification -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.duration.500ms
                    class="flex items-center justify-between bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl shadow-sm max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <!-- Controls Card -->
                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
                    <form action="{{ route('employees.index') }}" method="GET" class="w-full md:w-96">
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px] group-focus-within:text-indigo-600 transition-colors">search</span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none"
                                placeholder="Search name, ID, or department...">
                        </div>
                    </form>

                    <div class="flex items-center gap-2">
                        @if(auth()->user()->role === 'hr_admin')
                            <a href="{{ route('employees.create') }}"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2.5 px-5 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-95 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">person_add</span>
                                Add Employee
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100 text-left">
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Employee Name</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Employee ID</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Department</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest">Gender</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($employees as $employee)
                                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center overflow-hidden shrink-0">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=EEF2FF&color=4F46E5&size=128" alt="{{ $employee->name }}" class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-gray-900">{{ $employee->name }}</span>
                                                    <span class="text-[10px] text-gray-400 uppercase font-medium">{{ $employee->user->status }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono text-xs font-bold text-gray-600 px-2 py-1 bg-gray-100 rounded-md border border-gray-200">
                                                #{{ $employee->employee_id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $deptColor = match ($employee->department) {
                                                    'Information Technology', 'Engineering' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                    'Human Resources', 'Human Resource' => 'bg-purple-50 text-purple-700 border-purple-100',
                                                    'Marketing' => 'bg-pink-50 text-pink-700 border-pink-100',
                                                    'Finance' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                    'Sales' => 'bg-orange-50 text-orange-700 border-orange-100',
                                                    default => 'bg-slate-50 text-slate-700 border-slate-100',
                                                };
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $deptColor }}">
                                                {{ $employee->department }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                            {{ $employee->gender }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('employees.show', $employee) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="View">
                                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                </a>

                                                @if(auth()->user()->role === 'hr_admin')
                                                    <a href="{{ route('employees.edit', $employee) }}" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Edit">
                                                        <span class="material-symbols-outlined text-[20px]">edit_square</span>
                                                    </a>
                                                    
                                                    <!-- Delete Button triggers Modal -->
                                                    <button type="button" 
                                                        @click.prevent="
                                                            deleteModalOpen = true; 
                                                            employeeName = '{{ $employee->name }}'; 
                                                            deleteRoute = '{{ route('employees.destroy', $employee) }}'
                                                        "
                                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">search_off</span>
                                                <p class="text-sm font-medium">No employees found matching your search.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($employees->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                            {{ $employees->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- MODERN DELETE MODAL -->
        <div x-show="deleteModalOpen" 
             style="display: none;" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak>
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
                 x-show="deleteModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="deleteModalOpen = false"></div>

            <!-- Modal Content -->
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative w-full max-w-md transform overflow-hidden rounded-3xl bg-white p-8 shadow-2xl transition-all"
                     x-show="deleteModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex flex-col items-center text-center">
                        <!-- Warning Icon -->
                        <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-50 text-red-600 ring-4 ring-red-50">
                            <span class="material-symbols-outlined text-[40px]">delete_forever</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900">Delete Employee?</h3>
                        <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                            Are you sure you want to permanently remove <span class="font-semibold text-gray-900" x-text="employeeName"></span>? 
                            This action cannot be undone.
                        </p>
                    </div>

                    <div class="mt-8 flex flex-col gap-3">
                        <form :action="deleteRoute" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full rounded-xl bg-red-600 py-3 text-sm font-bold text-white shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-red-300 transition-all active:scale-[0.98]">
                                Yes, Delete Permanently
                            </button>
                        </form>
                        
                        <button type="button" 
                                @click="deleteModalOpen = false; deleteRoute = ''"
                                class="w-full rounded-xl bg-gray-100 py-3 text-sm font-bold text-gray-600 hover:bg-gray-200 transition-all">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>