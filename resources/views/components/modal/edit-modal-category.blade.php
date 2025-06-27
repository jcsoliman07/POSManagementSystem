@props(['category'])

<div id="edit-modal-category{{ $category->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
>
    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-custom-light-gray rounded-lg shadow-lg">

            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">

                <x-nav-heading>Edit Category</x-nav-heading>

                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-custom-dark-gray hover:text-custom-light-gray rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" 
                        onclick="closeModalCategory('edit-modal-category{{ $category->id }}')"> <!-- The Modal will close when it's click -->
                        
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                </button>
            </div>

            <x-forms.form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-4 flex flex-col h-full">

                    <div class="flex-grow">
                        <!-- Input fields -->
                        <div>
                            <x-forms.input label="Category Name" name="category" holder="Enter Category Name" value="{{ $category->name }}"/>
                        </div>

                    </div>
                    <!-- Cancel and Save Button -->
                    <div class="mt-4 flex gap-2 justify-end">
                        <x-buttons.button-cancel 
                            onclick="closeModalCategory('edit-modal-category{{ $category->id }}')"
                        >
                            Cancel
                        </x-buttons.button-cancel>
                        <x-buttons.button-save>Save</x-buttons.button-save>
                    </div>

                </div>

            </x-forms.form>
 
        </div>

    </div>
</div>
