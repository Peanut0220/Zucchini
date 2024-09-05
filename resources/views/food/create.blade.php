<x-admin-layout class="overflow-y-auto">
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
            <div class="max-w-4xl mx-auto px-4 py-6">
                <form action="{{ route('food.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Name Input -->
                    <div class="sm:col-span-2 mb-3">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Description Input -->
                    <div class="w-full mb-3">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus autocomplete="description" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <!-- Price Input -->
                    <div class="w-full mb-3">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" required autofocus autocomplete="price" />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <x-input-label for="dropzone-file" :value="__('Picture')" class="mb-2"/>
                    <!-- Image Upload and Preview -->
                    <div class="flex items-center justify-center w-full">

                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadWord">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" accept="image/*" class="hidden" />

                            <!-- Image Preview INSIDE dropzone -->
                            <img id="file-preview" class="hidden rounded-lg" src="" alt="Image Preview">
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <x-create-button type="submit" class="mt-3">Add</x-create-button>
                </form>
            </div>
        </div>
    </section>

    <!-- Image Preview and Validation Script -->
    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const preview = document.getElementById('file-preview');
            const uploadWord = document.getElementById('uploadWord');
            const label = fileInput.closest('label'); // Get the dropzone container

            // Allowed image file types
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];

            // Check if the uploaded file is an image
            if (file && allowedTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show the image preview inside the dropzone
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    // Hide the text and upload section
                    uploadWord.style.display = 'none';

                    // Create a temporary image to calculate its size
                    const tempImage = new Image();
                    tempImage.src = e.target.result;

                    tempImage.onload = function() {
                        const imageWidth = tempImage.width;
                        const imageHeight = tempImage.height;

                        // Resize the dropzone container to fit the image size
                        label.style.width = imageWidth + 'px';
                        label.style.height = imageHeight + 'px';
                    };
                };

                reader.readAsDataURL(file);
            } else {
                // Show an alert if the file is not an image
                alert('Please upload a valid image file (JPG, PNG, GIF, SVG).');
                uploadWord.style.display = 'block';
                fileInput.value = ''; // Clear the file input
                preview.classList.add('hidden'); // Ensure preview stays hidden

                // Reset the dropzone container size
                label.style.width = '100%';
                label.style.height = 'auto';
            }
        });
    </script>
</x-admin-layout>
