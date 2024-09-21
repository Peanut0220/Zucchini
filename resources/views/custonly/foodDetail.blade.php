{{--Author: Chong Jian--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Food Details') }}
        </h2>
    </x-slot>

    <section class="py-8 md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full dark:hidden" src="{{ Storage::url($food->image_path) }}" alt="{{ $food->name }}"/>
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $food->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            RM {{ $food->price }}
                        </p>
                    </div>
                    <form action="{{ route('addToCart', $food->food_id) }}" method="POST" class="mt-4">
                        @csrf
                    <!-- Quantity Selector -->
                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <div class="flex items-center">
                            <button type="button" id="decrease" class="px-3 py-1 bg-green-400  dark:bg-gray-700 rounded-l-md text-white dark:text-white">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-14 text-center border-t border-b h-8 border-gray-200 dark:bg-gray-800 dark:text-white" readonly />
                            <button type="button" id="increase" class="px-3 py-1 bg-green-400  dark:bg-gray-700 rounded-r-md text-white dark:text-white">+</button>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">



                            <x-create-button>Add to Cart</x-create-button>

                    </div>
                    </form>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $food->description }}
                    </p>

                </div>
            </div>
        </div>
    </section>

    <script>
        // Handle Quantity Input
        document.addEventListener('DOMContentLoaded', function () {
            const decreaseButton = document.getElementById('decrease');
            const increaseButton = document.getElementById('increase');
            const quantityInput = document.getElementById('quantity');
            const hiddenQuantityInput = document.getElementById('food-quantity');

            // Decrease quantity
            decreaseButton.addEventListener('click', function () {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    hiddenQuantityInput.value = currentValue - 1;
                }
            });

            // Increase quantity
            increaseButton.addEventListener('click', function () {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
                hiddenQuantityInput.value = currentValue + 1;
            });
        });
    </script>
</x-app-layout>
