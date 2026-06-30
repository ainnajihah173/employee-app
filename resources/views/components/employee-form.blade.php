@props(['employee' => null, 'action' => route('employees.store'), 'method' => 'POST'])

@php
    $isEdit = $employee !== null;
    $departments = ['Information Technology', 'Human Resource', 'Finance', 'Marketing', 'Sales', 'Operations', 'Engineering'];
@endphp

<div class="max-w-4xl mx-auto">
    
    <!-- Top Navigation (Back Button) -->
    <div class="mb-6">
        <a href="{{ route('employees.index') }}" 
           class="inline-flex items-center gap-2 px-3 py-2 text-on-surface-variant hover:text-primary transition-all font-bold text-sm group">
            <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Back to Directory
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white border border-outline-variant/30 shadow-2xl shadow-surface-dim/20 rounded-[2rem] overflow-hidden">
        
        <!-- Form Header -->
        <div class="px-8 py-8 bg-surface-container-low/30 border-b border-outline-variant/10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                    <span class="material-symbols-outlined text-[28px]">
                        {{ $isEdit ? 'edit_square' : 'person_add' }}
                    </span>
                </div>
                <div>
                    <h3 class="text-headline-sm text-on-surface font-bold tracking-tight">
                        {{ $isEdit ? 'Update Employee' : 'Register Employee' }}
                    </h3>
                    <p class="text-body-sm text-on-surface-variant">
                        {{ $isEdit ? "Modifying record for ID: #$employee->employee_id" : 'Enter the professional details for the new team member.' }}
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ $action }}" method="POST" class="p-8" id="employeeForm">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <!-- Employee ID (ReadOnly) -->
                <div class="space-y-1.5">
                    <label class="text-label-md font-bold text-on-surface ml-1">Employee ID</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px]">fingerprint</span>
                        <input type="text" value="{{ $employee->employee_id ?? 'Auto-generated' }}" 
                            class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/20 rounded-xl text-sm font-mono text-on-surface-variant/60 italic cursor-not-allowed" 
                            readonly disabled>
                    </div>
                </div>

                <!-- Full Name -->
                <div class="space-y-1.5">
                    <label for="name" class="text-label-md font-bold text-on-surface ml-1">Full Name</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">person</span>
                        <input type="text" name="name" id="name" value="{{ old('name', $employee->name ?? '') }}" required
                            class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none"
                            placeholder="e.g. John Doe">
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1 font-semibold ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email Address -->
                <div class="space-y-1.5 {{ $isEdit ? '' : 'md:col-span-1' }}">
                    <label for="email" class="text-label-md font-bold text-on-surface ml-1">Work Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">mail</span>
                        <input type="{{ $isEdit ? 'text' : 'email' }}" name="email" id="email" 
                            value="{{ $isEdit ? ($employee->user?->email) : old('email') }}" 
                            {{ $isEdit ? 'readonly disabled' : 'required' }}
                            class="w-full pl-10 pr-4 py-3 rounded-xl text-sm transition-all outline-none border {{ $isEdit ? 'bg-surface-container-low border-outline-variant/20 text-on-surface-variant/60 italic' : 'bg-white border-outline-variant/50 text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500' }}"
                            placeholder="name@company.com">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1 font-semibold ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Role Selector -->
                <div class="space-y-1.5">
                    <label for="role" class="text-label-md font-bold text-on-surface ml-1">System Access Role</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">shield_person</span>
                            <select name="role" id="role" required class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                                 <option value="">Select Role</option>
                                <option value="employee" {{ old('role', $employee->user?->role ?? '') == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="hr_admin" {{ old('role', $employee->user?->role ?? '') == 'hr_admin' ? 'selected' : '' }}>HR Admin</option>
                            </select>
                    </div>
                </div>

                <!-- Status -->
                 <div class="space-y-1.5">
                    <label for="status" class="text-label-md font-bold text-on-surface ml-1">User Status</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">shield_person</span>
                            <select name="status" id="status" required class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                                 <option value="">Select Status</option>
                                <option value="Active" {{ old('status', $employee->user?->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Suspend" {{ old('status', $employee->user?->status ?? '') == 'Suspend' ? 'selected' : '' }}>Suspend</option>
                            </select>
                    </div>
                </div>

               @if(!$isEdit)
                <!-- Password Creation -->
                <div class="space-y-1.5" x-data="{ showPass: false }">
                    <label for="password" class="text-label-md font-bold text-on-surface ml-1">Temporary Password</label>
                    <div class="flex gap-3">
                        <div class="relative flex-1 group">
                            <!-- Icon -->
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">key</span>
                            
                            <!-- Input Field -->
                            <input :type="showPass ? 'text' : 'password'" name="password" id="password" required
                                class="w-full pl-10 pr-12 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none font-mono"
                                placeholder="Generate secure password">
                            
                            <!-- Show/Hide Toggle Button -->
                            <button type="button" @click="showPass = !showPass" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 hover:text-indigo-600 transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-[20px]" x-text="showPass ? 'visibility_off' : 'visibility'">
                                    visibility
                                </span>
                            </button>
                        </div>

                        <!-- Generate Button -->
                        <button type="button" onclick="generatePassword()" 
                            class="px-4 py-2 bg-indigo-50 text-indigo-700 font-bold text-sm rounded-xl border border-indigo-200 hover:bg-indigo-100 transition-all active:scale-95 flex items-center gap-1 shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">autorenew</span>
                            Generate
                        </button>
                    </div>
                </div>
                @endif

                <!-- Department Selector -->
                <div class="space-y-1.5">
                    <label for="department" class="text-label-md font-bold text-on-surface ml-1">Department</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">corporate_fare</span>
                        <select name="department" id="department" required class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ old('department', $employee->department ?? '') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Gender Selector -->
                <div class="space-y-1.5">
                    <label for="gender" class="text-label-md font-bold text-on-surface ml-1">Gender</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-[20px] group-focus-within:text-indigo-600 transition-colors">wc</span>
                        <select name="gender" id="gender" required class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant/50 rounded-xl text-sm text-on-surface focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $employee->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $employee->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- Submit Action -->
            <div class="pt-10">
                <button type="submit" 
                    class="w-full bg-indigo-700 text-white py-4 rounded-2xl font-bold text-base shadow-xl shadow-indigo-200 hover:bg-indigo-800 hover:-translate-y-1 transition-all duration-200 active:scale-[0.98] flex items-center justify-center gap-3 group">
                    <span id="submitText">{{ $isEdit ? 'Update Employee Record' : 'Create System Profile' }}</span>
                    <span class="material-symbols-outlined text-[22px] group-hover:translate-x-1 transition-transform">
                        {{ $isEdit ? 'save_as' : 'arrow_forward' }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@if(!$isEdit)
<script>
    function generatePassword() {
        const chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789!@#%&*';
        let password = '';
        for (let i = 0; i < 14; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        
        const passwordInput = document.getElementById('password');
        passwordInput.value = password;

        // Interactive feedback: If Alpine is present, show the password automatically upon generation
        const alpineData = document.querySelector('[x-data]').__x.$data;
        if (alpineData && 'showPass' in alpineData) {
            alpineData.showPass = true;
        }

        // Visual flash to indicate success
        passwordInput.classList.add('bg-indigo-50');
        setTimeout(() => {
            passwordInput.classList.remove('bg-indigo-50');
        }, 500);
    }
</script>
@endif