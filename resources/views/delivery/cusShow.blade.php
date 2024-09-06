<x-app-layout>
    <section class="bg-white py-4 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mt-6 sm:mt-8 lg:grid lg:grid-cols-2 lg:gap-8">
                <!-- Delivery Details -->
                <div
                    class="w-full lg:col-span-1 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700">
                    <div class="space-y-4 p-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Order Details</h2>
                            <!-- Delivery Information -->
                            <div class="mb-6">
                                <div class="mb-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 pt-4">Delivery ID</label>
                                            <input type="text" value="{{ $delivery->id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 pt-4">Status</label>
                                            <input type="text" value="{{ $delivery->status }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Order ID</label>
                                            <input type="text" value="{{ $delivery->order_id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Updated At</label>
                                            <input type="text" value="{{ $delivery->created_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <div class="mb-6">
                                <h3 class="block text-sm font-medium text-gray-700 pb-2">Order Items</h3>
                                <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <table class="min-w-full table-auto">
                                        <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Item</th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantity
                                            </th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price</th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Item 1 -->
                                        <tr class="bg-gray-50">
                                            <td class="px-4 py-2 text-sm text-gray-900">Product A</td>
                                            <td class="px-11 py-2 text-sm text-gray-900">2</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$50.00</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$100.00</td>
                                        </tr>
                                        <!-- Item 2 -->
                                        <tr class="bg-gray-50">
                                            <td class="px-4 py-2 text-sm text-gray-900">Product B</td>
                                            <td class="px-11 py-2 text-sm text-gray-900">1</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$30.00</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$30.00</td>
                                        </tr>
                                        <!-- Item 3 -->
                                        <tr class="bg-gray-50">
                                            <td class="px-4 py-2 text-sm text-gray-900">Product C</td>
                                            <td class="px-11 py-2 text-sm text-gray-900">3</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$15.00</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">$45.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="mb-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <input type="text" value="Credit Card"
                                               class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                               disabled>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Total Amount</label>
                                        <input type="text" value="$145.00"
                                               class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order History -->
                <div class="mt-6 lg:mt-0 lg:col-span-1">
                    <div
                        class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Order history</h3>

                        <ol class="relative ms-3 border-s border-gray-200 dark:border-gray-700">
                            <!-- Pending Status -->
                            <li class="mb-10 ms-6">
                <span
                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6l4 2"/>
                    </svg>
                </span>
                                <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Pending</h4>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order received and
                                    pending confirmation</p>
                            </li>

                            <!-- Preparing Status -->
                            <li class="mb-10 ms-6">
                <span
                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100 ring-8 ring-white dark:bg-yellow-700 dark:ring-gray-800">
                    <svg class="h-4 w-4 text-yellow-500 dark:text-yellow-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 12h16M4 6h16M4 18h16"/>
                    </svg>
                </span>
                                <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Preparing</h4>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order is being
                                    prepared</p>
                            </li>

                            <!-- Delivering Status -->
                            <li class="mb-10 ms-6">
                <span
                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-700 dark:ring-gray-800">
                    <svg class="h-4 w-4 text-blue-500 dark:text-blue-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12h18l-4 4M3 12h18l-4-4"/>
                    </svg>
                </span>
                                <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Delivering</h4>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order is out for
                                    delivery</p>
                            </li>

                            <!-- Delivered Status -->
                            <li class="mb-10 ms-6">
                <span
                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-green-100 ring-8 ring-white dark:bg-green-700 dark:ring-gray-800">
                    <svg class="h-4 w-4 text-green-500 dark:text-green-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                                <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Delivered</h4>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order has been
                                    delivered</p>
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="gap-4 sm:flex sm:items-center">
                    <button type="button"
                            class="w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                        Cancel Order
                    </button>

                    <a href="#"
                       class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">Order
                        details</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
