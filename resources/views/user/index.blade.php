<x-layout>

<div class="w-full overflow-auto">

    <div class="container mx-auto py-8 bg-gray-100">
        <div class="flex flex-col lg:flex-row gap-6 mb-8">

            <!-- Left Side: Menu Selection -->
            <div class="w-ful lg:w-3/4">

                <!-- Header -->
                <div class="flex justify-between items-center mb-12">
                    <x-nav-heading class="">POS Management System</x-nav-heading>
                    <div class="yexy-custom-gray">
                        Staff Mode: Order Entry
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-12 border-b-2 border-custom-gray">
                    <div class="flex overflow-x-auto py-2 gap-2 mb-6">

                        <!-- All categories display all products-->
                        <x-buttons.button-product-header
                            type="button" 
                            data-category="all"
                            class="category-btn"
                        >
                            All Categories
                        </x-buttons.button-product-header>

                        <!-- Display all products per Category-->
                        @foreach ($categories as $category)
                            <x-buttons.button-product-header 
                                type="button"
                                class="category-btn" 
                                data-category="{{ $category->name }}"
                            >
                                {{ $category->name }}
                            </x-buttons.button-product-header>
                        @endforeach

                    </div>
                </div>
                
                <!-- Menu Products -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    @foreach ($products as $product)

                    <!-- Menu Item Card -->
                    <!-- Item Fecth from Product -->
                    <div class="product-card group menu-item bg-white rounded-lg overflow-hidden shadow cursor-pointer hover:scale-105 hover:translate-y-1 transition-transform duration-300 active:bg-custom-yellow mb-8"
                        data-category="{{ $product->category->name }}"
                        onclick="addToOrder({{ $product->id }})">

                        <!-- Product Image -->
                        <div class="relative pb-3/4">
                            <img 
                                src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0ccf4480-0602-495d-a9c5-2bec980bb886.png"
                                alt="{{ $product->description }}"
                                class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300 group-active:blur-[2px]"
                            >
                        </div>

                        <!-- Product Information -->
                        <div class="p-3">
                            <h3 class="font-bold text-gray-800"> {{ $product->name }} </h3>

                            <p class="text-sm text-gray-600"> {{ $product->description }} </p>

                            <div class="flex justify-between items-center mt-2">
                                <span class="font-bold text-red-600">₱ {{ $product->price }} </span>
                            </div>
                        </div>

                    </div>

                    @endforeach

                </div>
            </div>

            <!-- Right SIde Menu Order Summary-->
            <div class="w-full lg:w-1/4 mt-6 lg:mt-12">

                <div class="bg-white rounded-lg shadow-lg p-4 sticky top-8">

                    <!-- Roder Summary Header-->
                    <h2 class="text-xl fornt-bold text-custom-gray mb-4"> Order Summary </h2>

                    <!-- Order Items -->
                    <div class="order-table max-h-96 overflow-y-auto mb-4">
                        <div id="order-Items" class="space-y-2">
                            <!-- Items will be automatically added every click-->
                        </div>
                    </div>


                    <!--Total -->
                    <div class="border-t border-custom-light-gray pt-3">
                        <div class="flex justify-between mb-1">
                            <span class="text-custom-gray">Total: </span>
                            <span id="subtotal">₱ 0.00</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 space-y-3">
                        <button id="review-order-btn" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition duration-200 disabled:opacity-50" disabled> Review your Order </button>

                        <button id="place-order-btn" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium transition duration-200 disabled:opacity-50" disabled> Place Order </button>

                        <button id="clear-order-btn" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg font-medium transition duration-200" disabled> Clear Order </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--Review your Order Modal-->
    <div id="review-modal" class="fixed insert-0 bg-custom-gray bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <!--Review Items-->
            <div class="p-6">
                <h3 class="text-xl font-bold text-custom-gray mb-4">Review Order</h3>

                <div id="review-items" class="max-h-80 overflow-y-auto mb-4">
                    <!--Items will be automatically added -->
                </div>
        
            </div>
            
            <div class="border-t border-gray-200 pt-4">
                <!-- Items price -->
                <div class="flex justify-between font-bold text-lg text-red-600">

                    <span>Total:</span>
                    <span id="reviewTotal">₱0.00</span>

                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex-row-reverse rounded-b-lg">
                <!-- Order Button Confirm-->
                <button 
                    type="button" 
                    id="confirm-order-btn" 
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                > 
                    Confirm Order 

                </button>

                <!-- Order Button Cancel-->
                <button     
                    type="button" 
                    id="cancelReviewBtn" 
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Cancel

                </button>
            </div>
        </div>
    
    </div>

</x-layout>