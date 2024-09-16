<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-10 pb-10 mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex pb-3">
            <a href="{{route('category.create')}}" class="ml-auto"><x-create-button>Add </x-create-button></a>
        </div>

        <livewire:category-table/>
    </div>

</x-admin-layout>
