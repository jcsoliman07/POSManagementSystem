<x-index>

    <div class="mx-auto px-4">

        <div class="flex flex-cols flex-1 overflow-hidden">
            <!--Header Content-->
            <div class="flex-1 overflow-auto p-6">
                <div class="flex justify-between items-center mb-2">
                    <x-forms.heading>
                        Order Management 
                        <i class="fas fa-shopping-cart text-blue-400 text-2xl"></i>
                    </x-forms.heading>

                    <div class="">
                        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-file-export mr-2"></i> Export
                        </button>
                    </div>
                </div>

                <!-- Stats Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Today's Revenue Card -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Revenue</p>
                                <h3 class="text-2xl font-bold text-custom-yellow">$5,482.50</h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">+12% from yesterday</p>
                    </div>
                    <!-- Today's Orders Card -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Orders</p>
                                <h3 class="text-2xl font-bold text-custom-yellow">42</h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
                                <i class="fas fa-shopping-cart text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">+5 from yesterday</p>
                    </div>
                    <!-- Today's Order Items Card -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Items Sold</p>
                                <h3 class="text-2xl font-bold text-green-600">128</h3>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-boxes text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">+18 from yesterday</p>
                    </div>
                </div>


                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Filter Date Range Dropdown-->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                            <select class="w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 p-2">
                                <option>Today</option>
                                <option>Yesterday</option>
                                <option>This Week</option>
                                <option>This Month</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                            <input type="date" class="w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                            <input type="date" class="w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 p-2">
                        </div>
                </div>
            </div>
        </div>
    </div>

        {{-- @foreach ($orders as $order)
            <x-forms.heading>{{ $order->id }}</x-forms.heading>
            @foreach ($order->items as $item)
                <x-forms.paragraph>{{ $item->product->name }}</x-forms.paragraph>
            @endforeach
        @endforeach --}}
</x-index>