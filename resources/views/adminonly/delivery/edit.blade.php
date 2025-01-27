{{--Author: Shi Lei--}}
<x-admin-layout>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-3xl mx-auto mt-16">
        <h2 class="text-3xl font-semibold mb-6 text-center">Delivery Details</h2>

        <div class="mb-6">
            <h3 class="text-xl font-medium mb-4">Delivery Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Delivery ID</label>
                    <input type="text" value="{{ $delivery->delivery_id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Order ID</label>
                    <input type="text" value="{{ $delivery->order_id }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rider</label>
                    <input type="text" value="{{ $delivery->rider }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Created At</label>
                    <input type="text" value="{{ $delivery->created_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Updated At</label>
                    <input type="text" value="{{ $delivery->updated_at }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300" disabled>
                </div>

                <!-- Edit Status Form -->
                <div class="sm:col-span-2">
                    <form action="{{ route('delivery.update', $delivery) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Status Field -->
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md" required>
                            <option value="Pending" {{ $delivery->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Preparing" {{ $delivery->status == 'Preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="Delivering" {{ $delivery->status == 'Delivering' ? 'selected' : '' }}>Delivering</option>
                            <option value="Delivered" {{ $delivery->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <x-primary-button type="submit">Update Status</x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
