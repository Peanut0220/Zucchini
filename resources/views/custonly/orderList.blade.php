{{--Author: Shi Lei--}}
<x-app-layout>
    @if(session('paymentResult'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Payment Information!</strong>
            <span class="block sm:inline">{{ session('paymentResult') }}</span>
        </div>
    @endif



    <div class="max-w-7xl mt-10 pb-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex pb-3">
            <a href="{{route('export.orders')}}" class="ml-auto"><x-create-button>Generate XML </x-create-button></a>
        </div>
        <livewire:order-table/>
    </div>



</x-app-layout>
