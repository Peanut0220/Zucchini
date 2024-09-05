<x-app-layout>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Track the delivery of order
                #957684673</h2>

            <div class="mt-6 sm:mt-8 lg:grid lg:grid-cols-2 lg:gap-8">
                <!-- Delivery Details -->
                <div
                    class="w-full lg:col-span-1 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700">
                    <div class="space-y-4 p-6">
                        <div>
                            <h2 class="text-3xl font-semibold mb-6 text-center">Delivery Details</h2>
                            
                            <!-- Order Items -->
                            <div class="mb-6">
                                <h3 class="text-xl font-medium mb-4">Order Items</h3>
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
                            <!-- Order History Items -->
                            <li class="mb-10 ms-6">
                                <span
                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                         viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                                    </svg>
                                </span>
                                <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">
                                    Estimated
                                    delivery in 24 Nov 2023</h4>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Products
                                    delivered</p>
                            </li>
                            <!-- More Order History Items -->
                            <!-- ... -->
                        </ol>

                        <div class="gap-4 sm:flex sm:items-center">
                            <button type="button"
                                    class="w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                Cancel the order
                            </button>

                            <a href="#"
                               class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">Order
                                details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
