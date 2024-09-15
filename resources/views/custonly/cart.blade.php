<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    @if($cart->cartDetails->count() > 0)
                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            @method('DELETE')
                            <x-create-button class="mr-auto ml-auto bg-red-700">Clear All</x-create-button>
                        </form>
                    @endif

                    <div class="space-y-6 mt-2">
                        @forelse($cart->cartDetails as $cartDetail)
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="{{ route('food.show', $cartDetail->food_id) }}" class="shrink-0 md:order-1">
                                        <img class="h-20 w-20 dark:hidden" src="{{ Storage::url($cartDetail->food->image_path) }}" alt="{{ $cartDetail->food->name }}"/>
                                        <img class="hidden h-20 w-20 dark:block" src="{{ Storage::url($cartDetail->food->image_path) }}" alt="{{ $cartDetail->food->name }}"/>
                                    </a>

                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <form method="POST" action="{{ route('cart.update') }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="decrement inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                    </svg>
                                                </button>
                                                <input type="hidden" name="cartDetail_id" value="{{ $cartDetail->cartDetail_id }}">
                                                <input type="text" name="quantity" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 dark:text-white" value="{{ $cartDetail->quantity }}" required/>
                                                <button type="button" class="increment inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                    </svg>
                                                </button>
                                                <button type="submit" class="hidden">Update</button>
                                            </form>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-gray-900 dark:text-white">RM {{ $cartDetail->subtotal }}</p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="{{ route('food.show', $cartDetail->food->food_id) }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cartDetail->food->name }}</a>
                                    </div>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('cart.delete', $cartDetail->cartDetail_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-4 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-red-300 bg-red-100 hover:bg-red-200 dark:border-red-600 dark:bg-red-700 dark:hover:bg-red-600">
                                            <svg class="h-4 w-4 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-600 dark:text-gray-400">Your cart is empty.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">RM {{ $cart->total }}</dd>
                                </dl>
                                @if(session()->has('voucher_discount'))
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Voucher Discount ({{session('voucher_discount')*100}}%)</dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">
                                            - RM {{ number_format(number_format($cart->total, 2)* session('voucher_discount'),2) }}
                                        </dd>
                                    </dl>
                                @endif


                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (6%)</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">RM {{ number_format(($cart->total - number_format(number_format($cart->total, 2)* session('voucher_discount'),2))*0.06,2) }}</dd>
                                </dl>


                            </div>

                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    RM {{ number_format(($cart->total - number_format(number_format($cart->total, 2)* session('voucher_discount'),2))*1.06,2) }}
                                </dd>
                            </dl>
                        </div>
                        @if($cart->cartDetails->count() > 0)
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <a href="{{ route('checkout') }}">
                                        <x-create-button>Proceed to Checkout</x-create-button>
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                    Continue Shopping
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                    Continue Shopping
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Voucher Section -->
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">Have a Voucher?</p>

                        <!-- Check if there's a voucher in session -->
                        @if(session()->has('voucher'))
                            <!-- Display applied voucher code and a remove button -->
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-base font-medium text-gray-900 dark:text-white">Voucher: {{ session('voucher') }}</p>
                                <form method="POST" action="{{ route('voucher.remove') }}">
                                    @csrf
                                    <button type="submit" class="ml-4 rounded-md border border-gray-300 bg-red-100 px-4 py-2 font-semibold text-red-600 hover:bg-red-200 dark:bg-red-700 dark:text-white">
                                        Remove Voucher
                                    </button>
                                </form>
                            </div>

                        @else
                            <!-- Show form to apply voucher code -->
                            <form method="POST" action="{{ route('voucher.apply') }}">
                                @csrf
                                <label for="voucher" class="block text-sm font-medium text-gray-900 dark:text-white">Enter your voucher code</label>
                                <div class="mt-1 flex">
                                    <input type="text" name="voucher" id="voucher" class="block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 sm:text-sm dark:text-white" placeholder="Voucher code" required>
                                    <button type="submit" class="ml-4 rounded-md border border-gray-300 bg-gray-100 px-4 py-2 font-semibold text-gray-900 hover:bg-gray-200 dark:bg-gray-700 dark:text-white">
                                        Apply
                                    </button>
                                </div>

                                <!-- Show error message if voucher is invalid or expired -->
                                @if($errors->has('voucher_code'))
                                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('voucher_code') }}</p>
                                @endif

                                <!-- Show any success message for voucher application -->
                                @if(session('success'))
                                    <p class="mt-2 text-sm text-green-600">{{ session('success') }}</p>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.increment, .decrement').forEach(button => {
                button.addEventListener('click', function () {
                    let form = this.closest('form');
                    let input = form.querySelector('input[name="quantity"]');
                    let currentValue = parseInt(input.value);
                    let newValue = currentValue;

                    if (this.classList.contains('increment')) {
                        newValue = currentValue + 1;
                    } else if (this.classList.contains('decrement')) {
                        newValue = Math.max(currentValue - 1, 0); // Allow going to 0
                    }

                    input.value = newValue;

                    // Handle deletion if quantity is 0
                    if (newValue === 0) {
                        if (confirm('Are you sure you want to remove this item from your cart?')) {
                            // Set action to 'delete' in hidden input
                            let deleteInput = document.createElement('input');
                            deleteInput.setAttribute('type', 'hidden');
                            deleteInput.setAttribute('name', 'action');
                            deleteInput.setAttribute('value', 'delete');
                            form.appendChild(deleteInput);
                        } else {
                            // Reset the quantity if user cancels
                            input.value = currentValue;
                        }
                    }

                    // Submit the form
                    form.submit();
                });
            });
        });
    </script>
</x-app-layout>
