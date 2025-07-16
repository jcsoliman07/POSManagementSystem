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
            
            <!-- Modal Content -->
            <div class="p-6 space-y-2">
                <!-- Order Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Order Number</h4>
                        <p class="text-gray-800">{{ $order->order_number }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Order Date</h4>
                        <p class="text-gray-800">{{ $order->formatted_created_at }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Payment Method:</h4>
                        <p class="text-green-800 font-medium">Cash</p>
                    </div>
                </div>

                

            </div>

        </div>
    </div>
</div>