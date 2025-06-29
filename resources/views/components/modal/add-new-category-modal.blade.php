
<div id="add-new-category-modal" 
    tabindex="-1" 
    aria-hidden="true" 
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out">

    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-custom-light-gray rounded-lg shadow-lg">

            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">

                <x-nav-heading>Add Category</x-nav-heading>
                {{-- <h3 class="text-lg font-semibold text-custom-gray-900">Add New Category</h3> --}}

                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-custom-dark-gray hover:text-custom-light-gray rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        onclick="closeModal('add-new-category-modal')"> <!-- The Modal will close when it's click -->
                        
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                </button>

            </div>

            <x-forms.form method="POST" action="/category" >

                <div class="p-4 flex flex-col h-full">
                    <div class="flex-grow">

                        <div>
                            <x-forms.input label="Category Name" name="category" holder="Enter Category Name"/>
                        </div>

                    </div>

                    <div class="mt-4 flex gap-2 justify-end">
                        <x-buttons.button-cancel onclick="closeModal('add-new-category-modal')">Cancel</x-buttons.button-cancel>
                        <x-buttons.button-save>Save</x-buttons.button-save>
                    </div>
                </div>
                
            </x-forms.form>

        </div>

    </div>

</div>