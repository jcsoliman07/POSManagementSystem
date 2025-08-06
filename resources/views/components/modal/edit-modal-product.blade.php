@props(['product', 'categories'])

<div id="edit-modal-product{{ $product->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">

        <div class="relative p-8 bg-custom-light-gray rounded-lg shadow">

            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 border-gray-300">
                <x-nav-heading>Edit Product</x-nav-heading>

                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-custom-dark-gray hover:text-custom-light-gray rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        onclick="closeModal('edit-modal-product{{ $product->id }}')"> <!-- The Modal will close when it's click -->
                        
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal Body -->
            <x-forms.form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <!-- Product Name Input-->
                    <div class="mb-4">
                        <x-forms.input label="Product Name" name="product" holder="Enter Product Name" value="{{ $product->name }}"/>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <!-- Product Prize Input-->
                        <div class="relative">
                            <x-forms.input label="Prize" name="price" holder="₱ 000.00" value="{{ $product->price }}"/>
                        </div>

                        <!-- Product Category Input-->
                        <div>
                            <x-forms.select label="Category" name="category" :value="$product->category_id">

                                <option value="">
                                    --Select a Category--
                                </option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected($product->category_id == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                                
                            </x-forms.select>

                        </div>
                    </div>
                    
                    <!-- Product Description Input-->
                    <div class="mb-4">
                        <x-forms.text-area label="Description" name="description" holder="Write product description here..." value="{{ $product->description }}"/>
                    </div>

                    <div>
                        <!-- File input image -->
                        <x-forms.input type="file" label="Product Image" name="image" holder="Select Product Image" />

                        @if ($product->image)
                            <p class="mt-2 text-sm text-gray-600">Current file: {{ $product->image }}</p>

                            <!--Hidden input to keep the old existing image -->
                            <input type="hidden" name="existing_image" value="{{ $product->image }}">

                            {{-- Optional: Show image preview if it's an image --}}
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Current product image" class="w-24 mt-2 rounded">
                        @endif

                    </div>
                </div>

                <div class="mt-4 flex gap-2 justify-end">
                    <x-buttons.button-cancel 
                        onclick="closeModal('edit-modal-product{{ $product->id }}')"
                    >
                        Cancel
                    </x-buttons.button-cancel>

                    <x-buttons.button-save>Update</x-buttons.button-save>
                </div>

            </x-forms.form>
        </div>
    </div>
</div>
