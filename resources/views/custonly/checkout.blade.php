<x-app-layout>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Payment</h2>

                <!-- Display Flash Messages -->
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                    <form action="{{ route('checkout.process') }}" method="POST" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                        @csrf

                        <!-- Billing Contact Section -->
                        <div class="py-6 border-gray-200 dark:border-neutral-700">
                            <x-input-label for="billing-contact" :value="__('Billing contact')" />
                            <div class="mt-2 space-y-3">
                                <x-text-input id="billing-contact" name="first_name" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="First Name" value="{{ old('first_name') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />

                                <x-text-input name="last_name" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Last Name" value="{{ old('last_name') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />

                                <x-text-input name="phone" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Phone Number" value="{{ old('phone') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                        </div>

                        <!-- Delivery Address Section -->
                        <div class="py-6 border-t border-gray-200 dark:border-neutral-700">
                            <x-input-label for="billing-address" :value="__('Delivery address')" />
                            <div class="mt-2 space-y-3">
                                <x-text-input id="billing-address" name="street_address" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Street Address" value="{{ old('street_address') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('street_address')" />
                            </div>
                        </div>

                        <!-- Rider Selection Section -->
                        <div class="py-6 border-t border-gray-200 dark:border-neutral-700">
                            <x-input-label for="rider" :value="__('Choose Your Rider (COD)')" />
                            <div class="mt-2">
                                <select id="rider" name="rider" class="block w-full border-gray-200 shadow-sm rounded-lg" required>
                                    <option value="">-- Select Rider --</option>
                                    <option value="FoodPanda" {{ old('rider') == 'FoodPanda' ? 'selected' : '' }}>FoodPanda (RM 4.30)</option>
                                    <option value="Grab" {{ old('rider') == 'Grab' ? 'selected' : '' }}>Grab (RM 5.30)</option>
                                    <option value="ShopeeFood" {{ old('rider') == 'ShopeeFood' ? 'selected' : '' }}>ShopeeFood (RM 4.10)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('rider')" />
                            </div>
                        </div>

                        <!-- Payment Method Section -->
                        <div class="py-6 border-t border-gray-200 dark:border-neutral-700">
                            <x-input-label for="payment-method" :value="__('Payment method')" />
                            <div class="mt-2 space-y-3">
                                <x-text-input id="payment-method" name="card_name" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Name on Card" value="{{ old('card_name') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('card_name')" />

                                <x-text-input name="card_number" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Card Number" value="{{ old('card_number') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('card_number')" />

                                <x-text-input name="expiration_date" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="Expiration Date" value="{{ old('expiration_date') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('expiration_date')" />

                                <x-text-input name="cvv" type="text" class="block w-full border-gray-200 shadow-sm rounded-lg" placeholder="CVV" value="{{ old('cvv') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('cvv')" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <x-create-button type="submit" class="mt-3">Place Order</x-create-button>
                    </form>

                    <!-- Price Summary -->
                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">RM {{ $cart->total }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (6%)</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">RM {{ number_format($cart->total * 0.06, 2) }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total price</dt>
                                    <dd class="text-2xl font-semibold text-gray-900 dark:text-white">RM {{ number_format($cart->total + ($cart->total * 0.06), 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
