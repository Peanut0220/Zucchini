@php use App\Http\Controllers\CouponController; @endphp
{{--Author: Chong Jian--}}
<x-guest-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Food Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class=" py-8 antialiased dark:bg-gray-900 md:py-12">
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                    <!-- Heading & Filters -->
                    <div class="mb-4 space-y-4 sm:flex sm:space-y-0 md:mb-8">
                        <!-- Search Filter -->
                        <form action="{{ route('guestMenu') }}" method="GET" class="flex items-center space-x-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                                   class="border rounded px-4 py-2">
                            <x-create-button>Search</x-create-button>
                        </form>

                        <!-- Category Filter Dropdown -->
                        <div class="relative sm:ml-4">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-5 py-2 mt-0.5 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Categories
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <form action="{{ route('guestMenu') }}" method="GET">
                                        <select name="category" class="border rounded px-4 py-2 w-full">
                                            <option value="">All Categories</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-create-button class="mt-2 w-full">Filter</x-create-button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Food Menu Grid -->
                    <div class="grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-3">
                        @forelse ($foods as $food)
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <div class="h-56 w-full">
                                    <a href="#">
                                        <img class="mx-auto h-full dark:hidden"
                                             src="{{ Storage::url($food->image_path) }}" alt="{{ $food->name }}"/>
                                        <img class="mx-auto hidden h-full dark:block"
                                             src="{{ Storage::url($food->image_path) }}" alt="{{ $food->name }}"/>
                                    </a>
                                </div>
                                <div class="pt-6">
                                    <a href="#"
                                       class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $food->name }}</a>
                                    <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">
                                        RM {{ $food->price }}
                                    </p>
                                    <div class="mt-4 flex items-center justify-between gap-4">
                                        <a href="{{ route('foodDetail', ['food' => $food->food_id]) }}">
                                            <x-create-button>Add to Cart</x-create-button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Centered "No items found" message -->
                            <div class="col-span-full flex items-center justify-center">
                                <p class="text-center text-gray-600 dark:text-gray-400">No food items found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($foods->hasPages())
                        <div class="mt-8">
                            {{ $foods->appends(request()->query())->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
    </x-guest-default-layout>

