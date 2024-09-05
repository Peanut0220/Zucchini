<x-admin-layout>
    <div class="max-w-7xl mt-10 pb-10 mx-auto px-4 sm:px-6 lg:px-8">

<div class="flex pb-3">
    <a href="{{route('food.create')}}" class="ml-auto"><x-create-button>Add </x-create-button></a>
</div>
<livewire:food-table/>
    </div>

</x-admin-layout>
