{{--Author: Chong Jian--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coupons') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($coupons as $coupon)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3 0 1.657 1.343 3 3 3s3-1.343 3-3-1.343-3-3-3z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636c3.11 3.11 3.11 8.189 0 11.298l-1.414-1.414c2.344-2.344 2.344-6.132 0-8.475l1.414-1.409z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-bold text-gray-900">{{ $coupon['code'] }}</h2>
                            <p class="text-gray-600">Discount: {{ $coupon['discount'] *100}}%</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
