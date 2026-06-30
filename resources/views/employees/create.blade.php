<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Employee') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-employee-form action="{{ route('employees.store') }}" method="POST" />
        </div>
    </div>
</x-app-layout>