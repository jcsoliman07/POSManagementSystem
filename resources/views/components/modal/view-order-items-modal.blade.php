@props(['order'])
<!-- Order Items -->

<div id="view-order-items-modal{{ $order->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Order Number</h4>
                        <p class="text-gray-800">{{ $order->order_number }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Order Date</h4>
                        <p class="text-gray-800">{{ $order->formatted_created_at }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Customer</h4>
                        <p class="text-gray-800">{{ $order->customer }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500">Payment Method:</h4>
                        <p class="text-green-800 font-medium">
                            {{ $order->payment_method == 'C' ? 'Cash' :  'E-Money' }}
                        </p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Order Items</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qty
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($order->items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                           {{ $item->product->category->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->product->price }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                           ₱ {{ number_format($item->total_price , 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Totals -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-end">
                    <div class="w-full md:w-1/3">
                        <div class="flex justify-between py-2 border-t border-gray-200 mt-2">
                            <span class="text-base font-medium">Total:</span>
                            <span class="text-base font-medium">₱ {{ number_format($order->total_amount , 2 ,'.', ',') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex gap-2 justify-end">
                <x-buttons.button-cancel 
                    onclick="closeModal('view-order-items-modal{{ $order->id }}')"
                >
                    Close
                </x-buttons.button-cancel>
            </div>

        </div>
    </div>
</div>