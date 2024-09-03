<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
            <form action="{{route('food.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="w-full">

                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                     </div>
                    <div class="w-full">

                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                     </div>


                </div>
               <x-primary-button type="submit">Add</x-primary-button>
            </form>

        </div>
    </section>
</x-app-layout>
