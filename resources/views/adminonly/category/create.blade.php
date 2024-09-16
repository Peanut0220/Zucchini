{{--Author: Shi Lei--}}
<x-admin-layout class="overflow-y-auto">
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new category</h2>
            <div class="max-w-4xl mx-auto px-4 py-6">
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Name Input -->
                    <div class="sm:col-span-2 mb-3">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Submit Button -->
                    <x-create-button type="submit" class="mt-3">Add</x-create-button>
                </form>
            </div>
        </div>
    </section>
</x-admin-layout>
