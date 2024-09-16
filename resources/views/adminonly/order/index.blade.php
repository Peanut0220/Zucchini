<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-10 pb-10 mx-auto px-4 sm:px-6 lg:px-8">

        <livewire:order-list-table/>
    </div>

</x-admin-layout>
