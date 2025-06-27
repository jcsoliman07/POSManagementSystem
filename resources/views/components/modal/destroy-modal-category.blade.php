@props(['category'])

<div id="destroy-modal-category{{ $category->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-custom-gray bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
>
    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-white rounded-lg shadow-sm dark:bg-custom-gray">

            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal"
                onclick="closeModalDestroy('destroy-modal-category{{ $category->id }}')"> <!-- The Modal will close when it's click -->

                <i class="fa-solid fa-xmark"></i>
                <span class="sr-only">Close modal</span>
            </button>

            <x-forms.form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="p-4 md:p-5 text-center">
                    <div class="flex justify-center items-center h-full mb-6">
                        <i class="fa-solid fa-circle-exclamation text-5xl text-custom-yellow"></i>
                    </div>

                    <x-forms.input type="hidden" name="category" value="{{ $category->id }}" holder="Ente Category" label="Category ID"/>
                        
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button 
                            type="button"
                            onclick="closeModalDestroy('destroy-modal-category{{ $category->id }}')"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    >
                        No, cancel
                    </button>
                </div>
            </x-forms.form>
            
        </div>

    </div>

</div>
