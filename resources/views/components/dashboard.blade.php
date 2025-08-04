<x-index>
    <div class="bg-white rounded-lg shadow-sm p-6">
        <x-forms.heading>Welcome back,

            @switch(auth()->user()->role->name)
                @case('super_admin')
                    Super Administrator
                    @break
                @case('admin')
                    Administrator
                    @break
                @default
                    --
            @endswitch
            !
        </x-forms.heading>
        <x-forms.paragraph class="text-md mb-6 border-b pb-2">This is the main content area. You can add your POS components here.</x-forms.paragraph>
        
        <!-- Dashboard grid Data -->
        <div class="grid grid-cols-12 auto-rows-[minmax(120px,_auto)] gap-5">
            <div class="bg-white p-6 rounded-xl shadow col-span-3 hover:-translate-y-[5px] hover:shadow-lg hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-custom-yellow-light text-custom-yellow mr-4">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Today's Revenue</p>
                        <h3 class="text-2xl font-bold">₱ {{ number_format($todayStats->total_amount ?? 0, 2) }}</h3>
                        <p class="text-sm mt-1
                            {{ $RevenueDifferencePercentage >= 50 ? 'text-green-500' : ($RevenueDifferencePercentage >= 0 ? 'text-yellow-500' : 'text-red-500')  }}
                        "> {{ $RevenueDifferencePercentage >= 0 ? '+' : '' }} {{ $RevenueDifferencePercentage }}% from yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow col-span-3 hover:-translate-y-[5px] hover:shadow-lg hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-custom-yellow-light text-custom-yellow mr-4">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Today's Orders</p>
                        <h3 class="text-2xl font-bold">{{ $todayStats->order_count ?? 0 }}</h3>
                        <p class="text-sm mt-1
                                {{ $OrderDifferencePercentage >= 50 ? 'text-green-500' : ($OrderDifferencePercentage >= 0 ? 'text-yellow-500' : 'text-red-500') }}
                        ">{{ $OrderDifferencePercentage >= 0 ? '+' : '' }} {{ $OrderDifferencePercentage }}% from yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow col-span-3 hover:-translate-y-[5px] hover:shadow-lg hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-custom-yellow-light text-custom-yellow mr-4">
                        <i class="fa-solid fa-clipboard"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Total Items</p>
                        <h3 class="text-2xl font-bold">{{ $todayStats->total_items_sold ?? 0 }}</h3>
                        <p class="text-sm mt-1
                            {{ $OrderItemDifferencePercentage >= 50 ? 'text-green-500' : ($OrderItemDifferencePercentage >= 0 ? 'text-yellow-500' : 'text-red-500')}}"
                        >
                            {{ $OrderItemDifferencePercentage >= 0 ? '+' : ' ' }} {{ $OrderItemDifferencePercentage }}% from yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow col-span-3 hover:-translate-y-[5px] hover:shadow-lg hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-custom-yellow-light text-custom-yellow mr-4">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Customers for Today</p>
                        <h3 class="text-2xl font-bold">{{ $todayStats->customer_count ?? 0 }}</h3>
                        <p class="text-sm mt-1
                            {{ $CustomerDifferencePercentage >= 50 ? 'text-green-500' : ($CustomerDifferencePercentage >= 0 ? 'text-yellow-500' : 'text-red-500')}}"
                        >{{ $CustomerDifferencePercentage >= 0 ? '+' : '' }} {{ $CustomerDifferencePercentage }}% from yesterday</p>
                    </div>
                </div>
            </div>

            <!-- Sales Trends Chart -->
            <div class="bg-white p-6 rounded-xl shadow-md col-span-8 row-span-2">
                <div class="flex justify-between items-center mb-6">
                    <x-forms.heading>Sales Trends</x-forms.heading>
                </div>
                <canvas id="salesChart" class="max-h-2xl"></canvas>
            </div>

            <!-- Payment Methods Breakdown -->
            <div class="bg-white p-6 rounded-xl shadow col-span-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">Payment Methods</h2>
                <canvas id="paymentChart" height="230"></canvas>
            </div>

            <!-- Top Selling Products -->
            <div class="bg-white p-6 rounded-xl shadow col-span-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">Top Selling Products</h2>

                <div class="space-y-2">

                    @foreach ($TopSelling as $item)
                        <div class="flex items-center rounded-lg hover:-translate-y-1 hover:scale-105 hover:shadow-md p-4 transition duration-300 ease-out">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0ccf4480-0602-495d-a9c5-2bec980bb886.png" alt="{{ $item->product }}" class="w-10 h-10 rounded-md object-cover mr-3">

                            <div class="flex-1">
                                <p class="font-medium">{{$item->product}}</p>
                            </div>

                            <div class="text-center">   
                                <p class="font-bold text-800 text-lg text-green-500">{{$item->total_product_quantity}} </p>
                                <p class="text-gray-500 text-sm">total sold</p>
                            </div>
                        </div>
                    @endforeach
                
                </div>
            </div>

        </div>

    </div>

<script>
    window.weekSalesChart = @json($weekSalesChart);
    window.paymentChart = @json($paymentChart);
</script>
</x-index>
