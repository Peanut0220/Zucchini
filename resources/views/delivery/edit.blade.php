<x-app-layout>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-3xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6 text-center">Edit Delivery Status</h2>

        <form method="POST" action="{{ route('delivery.update', $delivery->id) }}">
            @csrf
            @method('PATCH')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" name="status" value="{{ old('status', $delivery->status) }}" class="mt-1 p-2 block w-full bg-gray-100 rounded-md border-gray-300 @error('status') border-red-500 @enderror">

                @error('status')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Status</button>
            </div>
        </form>
    </div>
</x-app-layout>
