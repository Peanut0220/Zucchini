<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Food') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mt-10 pb-10 mx-auto px-4 sm:px-6 lg:px-8">

<div class="flex pb-3">
    <a href="{{route('food.create')}}" class="ml-auto"><x-create-button>Add </x-create-button></a>
</div>
        <div class="flex pb-3">
            <a href="{{route('export.foods')}}" class="ml-auto"><x-create-button>Generate XML </x-create-button></a>
        </div>

<livewire:food-table/>
    </div>

</x-admin-layout>
