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
                                            <input type="text" value="{{ $delivery->delivery_id }}"
                                                   class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                                   disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 pt-4">Rider</label>
                                            <input type="text" value="{{ $delivery->rider }}"
                                                   class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                                   disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Order ID</label>
                                            <input type="text" value="{{ $order->order_id }}"
                                                   class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                                   disabled>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Updated At</label>
                                            <input type="text" value="{{ $delivery->updated_at }}"
                                                   class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                                   disabled>
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
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantity</th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price</th>
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order->details as $item)
                                            <tr class="bg-gray-50">
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $item->food->name }}</td>
                                                <td class="px-11 py-2 text-sm text-gray-900">{{ $item->quantity }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">RM {{ $item->price }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">RM {{ $item->subtotal }}</td>
                                            </tr>
                                        @endforeach
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
                                        <input type="text" value="RM {{ $order->final }}"
                                               class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Order History</h3>

                    <ol class="relative mt-0 dark:border-gray-700">
                        <!-- Pending Status -->
                        <li class="pb-6 pl-9 border-l {{ in_array($delivery->status, ['Preparing', 'Delivering', 'Delivered']) ? 'border-gray-500' : 'border-gray-200' }}">
            <span
                class="absolute -left-2 top-1 flex h-6 w-6 items-center justify-center rounded-full {{ $delivery->status == 'Pending' || in_array($delivery->status, ['Preparing', 'Delivering', 'Delivered']) ? 'bg-green-500' : 'bg-gray-100' }} ring-8 ring-white dark:ring-gray-800">
                <!-- SVG Icon for Pending -->
            </span>
                            <h4 class="text-base font-semibold {{ $delivery->status == 'Pending' ? 'text-green-500' : 'text-gray-900' }}">
                                Pending</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order received and pending confirmation</p>
                        </li>
                    </ol>

                    <ol class="relative mt-0 dark:border-gray-700">
                        <!-- Preparing Status -->
                        <li class="pb-6 pl-9 border-l {{ in_array($delivery->status, ['Delivering', 'Delivered']) ? 'border-gray-500' : 'border-gray-200' }}">
            <span
                class="absolute -left-2 top-1 flex h-6 w-6 items-center justify-center rounded-full {{ in_array($delivery->status, ['Preparing', 'Delivering', 'Delivered']) ? 'bg-green-500' : 'bg-gray-100' }} ring-8 ring-white dark:ring-gray-800">
                <!-- SVG Icon for Preparing -->
            </span>
                            <h4 class="text-base font-semibold {{ $delivery->status == 'Preparing' ? 'text-green-500' : 'text-gray-900' }}">
                                Preparing</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order is being prepared</p>
                        </li>
                    </ol>

                    <ol class="relative mt-0 dark:border-gray-700">
                        <!-- Delivering Status -->
                        <li class="pb-6 pl-9 border-l {{ in_array($delivery->status, ['Delivered']) ? 'border-gray-500' : 'border-gray-200' }}">
            <span
                class="absolute -left-2 top-1 flex h-6 w-6 items-center justify-center rounded-full {{ in_array($delivery->status, ['Delivering', 'Delivered']) ? 'bg-green-500' : 'bg-gray-100' }} ring-8 ring-white dark:ring-gray-800">
                <!-- SVG Icon for Delivering -->
            </span>
                            <h4 class="text-base font-semibold {{ $delivery->status == 'Delivering' ? 'text-green-500' : 'text-gray-900' }}">
                                Delivering</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order is out for delivery</p>
                        </li>
                    </ol>

                    <ol class="relative mt-0 dark:border-gray-700">
                        <!-- Delivered Status -->
                        <li class="pb-6 pl-9 ">
            <span
                class="absolute -left-2 top-1 flex h-6 w-6 items-center justify-center rounded-full {{ $delivery->status == 'Delivered' ? 'bg-green-500' : 'bg-gray-100' }} ring-8 ring-white dark:ring-gray-800">
                <!-- SVG Icon for Delivered -->
            </span>
                            <h4 class="text-base font-semibold {{ $delivery->status == 'Delivered' ? 'text-green-500' : 'text-gray-900' }}">
                                Delivered</h4>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Order has been delivered</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
