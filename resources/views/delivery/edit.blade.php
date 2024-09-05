<x-app-layout>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-3xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6 text-center">Delivery Details</h2>

        <!-- Delivery Information -->
        <div class="mb-6">
            <h3 class="text-xl font-medium mb-4">Delivery Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Delivery ID</label>
                    <input type="text" value="{{ $delivery->id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" value="{{ $delivery->status }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Order ID</label>
                    <input type="text" value="{{ $delivery->order_id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Created At</label>
                    <input type="text" value="{{ $delivery->created_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Updated At</label>
                    <input type="text" value="{{ $delivery->updated_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Updated At</label>
                    <input type="text" value="{{ $delivery->updated_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h3 class="text-xl font-medium mb-4">Order Items</h3>
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
            <h3 class="text-xl font-medium mb-4">Payment Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <input type="text" value="Credit Card" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Amount</label>
                    <input type="text" value="$145.00" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('delivery.index') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                Change the position of this backkkk button
            </a>
        </div>
    </div>
</x-app-layout>
