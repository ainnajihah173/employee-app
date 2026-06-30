<x-app-layout x-data="{ deleteModalOpen: false }">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800 leading-tight">
                {{ __('Employee Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Navigation & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <a href="{{ route('employees.index') }}"
                class="inline-flex items-center gap-2 text-slate-500 hover:text-indigo-600 transition-colors text-sm font-medium group">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                Back to Directory
            </a>

            @if(auth()->user()->role === 'hr_admin')
                <div class="flex items-center gap-2">
                    <a href="{{ route('employees.edit', $employee) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit Profile
                    </a>
                    <button onclick="document.getElementById('deleteModal').style.display='flex'"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-red-200 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Delete
                    </button>
                </div>
            @endif
        </div>

        <!-- Profile Overview Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center gap-6">
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=f1f5f9&color=6366f1&size=128"
                        alt="{{ $employee->name }}" class="w-24 h-24 rounded-lg border border-slate-200 shadow-sm">
                    <div class="absolute -bottom-2 -right-2 w-6 h-6 {{ $employee->user->status === 'Active' ? 'bg-emerald-500' : 'bg-red-500'  }} border-4 border-white rounded-full"
                        title="Status Account"></div>
                </div>

                <!-- Basic Info -->
                <div class="flex-1 space-y-1">
                    <h1 class="text-2xl font-bold text-slate-900">{{ $employee->name }}</h1>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                        <div class="flex items-center gap-1.5 text-slate-500 text-sm">
                            <span class="material-symbols-outlined text-[18px]">corporate_fare</span>
                            {{ $employee->department }}
                        </div>
                        <div class="flex items-center gap-1.5 text-slate-500 text-sm">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                            Joined {{ $employee->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="hidden lg:block px-6 py-2 bg-slate-50 border border-slate-100 rounded-lg text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Account Status</p>
                    <p
                        class="text-sm font-bold uppercase mt-0.5 {{ $employee->user->status === 'Active' ? 'text-emerald-600' : 'text-red-600' }}">
                        {{ $employee->user->status }}
                    </p>

                </div>
            </div>

            <!-- Detailed Stats Bar -->
            <div class="grid grid-cols-1 md:grid-cols-3 border-t border-slate-100 bg-slate-50/50">
                <div class="px-8 py-4 border-b md:border-b-0 md:border-r border-slate-100">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Internal ID</label>
                    <p class="text-sm font-mono font-semibold text-slate-700 mt-0.5">#{{ $employee->employee_id }}</p>
                </div>
                <div class="px-8 py-4 border-b md:border-b-0 md:border-r border-slate-100">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Gender</label>
                    <p class="text-sm font-semibold text-slate-700 mt-0.5">{{ $employee->gender }}</p>
                </div>
                <div class="px-8 py-4">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">System Access</label>
                    <p class="text-sm font-semibold text-slate-700 mt-0.5 capitalize">
                        {{ $employee->user ? str_replace('_', ' ', $employee->user->role) : 'None' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Information Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Contact Information -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-[20px]">contact_mail</span>
                    <h3 class="font-bold text-slate-800 text-sm italic">Contact Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs font-medium text-slate-400 block">Work Email</label>
                        @if($employee->user)
                            <a href="mailto:{{ $employee->user->email }}"
                                class="text-sm font-semibold text-indigo-600 hover:underline">{{ $employee->user->email }}</a>
                        @else
                            <p class="text-sm text-slate-400 italic">No email assigned</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Employment Details -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-400 text-[20px]">work</span>
                    <h3 class="font-bold text-slate-800 text-sm italic">Employment Details</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <label class="text-xs font-medium text-slate-400">Department</label>
                        <span class="text-sm font-semibold text-slate-700">{{ $employee->department }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <label class="text-xs font-medium text-slate-400">Position Type</label>
                        <span class="text-sm font-semibold text-slate-700">Full-time</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="deleteModal" style="display: none;"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm">

        <div class="bg-white w-full max-w-sm rounded-xl shadow-2xl overflow-hidden border border-slate-200">

            <div class="p-6">
                <div class="flex items-center gap-3 text-red-600 mb-4">
                    <span class="material-symbols-outlined">warning</span>
                    <h3 class="text-lg font-bold">Delete Employee</h3>
                </div>

                <p class="text-sm text-slate-600 leading-relaxed">
                    Are you sure you want to delete <span
                        class="font-bold text-slate-900">{{ $employee->name }}</span>?
                    This will immediately disable their login and system permissions.
                </p>
            </div>

            <div class="px-6 py-4 bg-slate-50 flex flex-col sm:flex-row-reverse gap-2">
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-700 transition-colors">
                        Delete Record
                    </button>
                </form>
                <button onclick="document.getElementById('deleteModal').style.display='none'"
                    class="w-full sm:w-auto px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-100 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</x-app-layout>