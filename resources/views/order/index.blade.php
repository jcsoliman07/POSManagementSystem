<x-index>

    <div class="mx-auto px-4">
        <div class="flex flex-cols flex-1 overflow-hidden">
            <!--Header Content-->
            <div class="flex-1 overflow-auto p-6">
                <div class="flex justify-between items-center mb-2">
                    <x-forms.heading>
                        Order Management 
                        <i class="fas fa-shopping-cart text-custom-yellow text-2xl"></i>
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
                                <h3 class="text-2xl font-bold text-custom-yellow">128</h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
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
                        <div class="border-r-2 border-yellow-500 pr-4">
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

                <!-- Orders Table -->
                <div class="bg-white rounded-md shadow overflow-hidden mb-8">
                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Order ID
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Date
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Staff
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Customer
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Items
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Total
                                    </th>

                                    <th 
                                        scope="col" 
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-custom-yellow-darker">
                                                {{ $order->order_number }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                10:45 AM, Today
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $order->user->name }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $order->customer }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $order->items->count() }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                ₱ {{ number_format($order->total_amount, 2, '.', ',') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-indigo-600 hover:text-indigo-900">View</button>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>

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