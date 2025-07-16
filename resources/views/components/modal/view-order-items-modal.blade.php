@props(['order'])
<!-- Order Items -->

<div id="view-order-items-modal{{ $order->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
>
    <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <div class="relative p-4 bg-custom-light-gray rounded-lg shadow">

            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <x-nav-heading>Order Details</x-nav-heading>

                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-custom-dark-gray hover:text-custom-light-gray rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        onclick="closeModal('view-order-items-modal{{ $order->id }}')"> <!-- The Modal will close when it's click -->
                        
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                </button>
            </div>

        </div>
    </div>
</div>