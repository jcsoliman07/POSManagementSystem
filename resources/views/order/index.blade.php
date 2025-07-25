<x-index>

    <div class="mx-auto px-4">
        <div class="flex flex-cols flex-1 overflow-hidden">
            <!--Header Content-->
            <div class="flex-1 overflow-auto p-2">
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
                    <div class="bg-white rounded-lg shadow p-6 hover:-translate-y-1 hover:scale-105 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Revenue</p>
                                <h3 class="text-2xl font-bold text-custom-yellow">₱ {{ number_format($todayStats->total_amount ?? 0, 2)}} </h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500
                                {{ $RevenueDifferencePercentage >= 50 ? 'text-green-500' : ($RevenueDifferencePercentage >= 0 ? 'texy-yellow-500' : 'text-red-500') }}
                        ">
                            {{ $RevenueDifferencePercentage >= 0 ? '+' : '' }}{{$RevenueDifferencePercentage}}% from yesterday
                        </p>
                    </div>
                    <!-- Today's Orders Card -->
                    <div class="bg-white rounded-lg shadow p-6 hover:-translate-y-1 hover:scale-105 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Orders</p>
                                <h3 class="text-2xl font-bold text-custom-yellow">{{ $todayStats->order_count ?? 0 }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
                                <i class="fas fa-shopping-cart text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">+5 from yesterday</p>
                    </div>
                    <!-- Today's Order Items Card -->
                    <div class="bg-white rounded-lg shadow p-6 hover:-translate-y-1 hover:scale-105 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 font-medium">Today's Items Sold</p>
                                <h3 class="text-2xl font-bold text-custom-yellow">{{ $todayStats->total_items_sold ?? 0 }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-custom-yellow-light text-custom-yellow">
                                <i class="fas fa-boxes text-xl"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">+18 from yesterday</p>
                    </div>
                </div>


                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-end md:space-x-6 space-y-4 md:space-y-0">

                        <!-- Date Range Dropdown with Border Right -->
                        <div class="md:border-r border-yellow-400 md:pr-6 flex-1">
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Date Range</label>
                            <select id="filterDate" onchange="filterOrderData('dropdown')"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                                <option value="all">All</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="thisWeek">This Week</option>
                            </select>
                        </div>

                        <!-- From and To Date Inputs -->
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">From Date</label>
                                <input type="date" id="startDate" onchange="filterOrderData('daterange')"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                                </div>
                                <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">To Date</label>
                                <input type="date" id="endDate" onchange="filterOrderData('daterange')"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                                </div>
                            </div>
                        </div>

                        <!-- Filter & Reset Buttons -->
                        <div class="flex items-end gap-3">
                            <button title="Reset Filter"
                                class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-100 text-yellow-500 hover:bg-yellow-200 transition">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Orders Table -->
                <div class="bg-white rounded-md shadow overflow-hidden mb-8">
                    <div class="overflow-x-auto">

                        <table id="myOrderTable" class="min-w-full divide-y divide-gray-200">
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
                                        <tr class="hover:bg-gray-100"  data-date="{{ $order->created_at->format('Y-m-d') }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-custom-yellow-darker">
                                                {{ $order->order_number }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $order->formatted_created_at }}
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
                                                {{-- <button class="text-indigo-600 hover:text-indigo-900">View</button> --}}
                                                <x-buttons.view-order-items-button :order="$order" >View</x-buttons.view-order-items-button>
                                                <x-modal.view-order-items-modal :order="$order"/>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing 
                                    <span class="font-medium">{{ $orders->firstItem() }}</span> 
                                    to <span class="font-medium">{{ $orders->lastItem() }}</span> 
                                    of <span class="font-medium">{{ $orders->total() }}</span> 
                                    orders
                                </p>
                            </div>
                            <div>
                                {{ $orders->links('pagination::tailwind') }}
                            </div>
                        </div>
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