@props(['categories']) <!-- Passing the categories from parent blade index -->

<div id="add-new-product-modal" 
    tabindex="-1" 
    aria-hidden="true" 
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out">

    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-custom-light-gray rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <x-nav-heading>Add Product</x-nav-heading>

                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-custom-dark-gray hover:text-custom-light-gray rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        onclick="closeModal('add-new-product-modal')"> <!-- The Modal will close when it's click -->
                        
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <x-forms.form action="/products" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <!-- Product Name Input-->
                    <div class="mb-4">
                        <x-forms.input label="Product Name" name="product" holder="Enter Product Name" value="{{ old('product') }}"/>
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <!-- Product Prize Input-->
                        <div>
                            <x-forms.input label="Prize" name="price" holder="₱ 000.00" value="{{ old('price') }}"/>
                        </div>

                        <!-- Product Category Input-->
                        <div>
                            <x-forms.select label="Category" name="category">
                                <option value="">--Select a Category</option>

                                @foreach ($categories as $category) <!-- Display each category -->
                                    <option value="{{ $category->id}}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                                
                            </x-forms.select>

                        </div>
                    </div>
                    
                    <!-- Product Description Input-->
                    <div class="mb-4">
                        <x-forms.text-area label="Description" name="description" holder="Write product description here..." value="{{ old('description') }}"/>
                    </div>

                    <div>
                        <x-forms.input type="file" label="Product Image" name="image" holder="Select Product Image"/>
                    </div>
                </div>

                <div class="mt-4 flex gap-2 justify-end">
                    <x-buttons.button-cancel onclick="closeModal('add-new-product-modal')">Cancel</x-buttons.button-cancel>
                    <x-buttons.button-save>Save</x-buttons.button-save>
                </div>

            </x-forms.form>
                
        </div>
    </div>
</div>