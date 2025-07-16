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
            <div class="bg-white p-6 rounded-xl shadow metric-card col-span-3">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-shopping-cart text-blue-400 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Today's Revenue</p>
                        <h3 class="text-2xl font-bold">₱ {{ number_format($todayStats->total_amount ?? 0, 2) }}</h3>
                        <p class="text-green-500 text-sm mt-1">+12% from yesterday</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow metric-card col-span-3">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Today's Orders</p>
                        <h3 class="text-2xl font-bold">{{ $todayStats->order_count ?? 0 }}</h3>
                        <p class="text-green-500 text-sm mt-1">+6% from yesterday</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow metric-card col-span-3">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                        <i class="fa-solid fa-clipboard"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Total Items</p>
                        <h3 class="text-2xl font-bold">{{ $todayStats->total_items_sold ?? 0 }}</h3>
                        <p class="text-green-500 text-sm mt-1">+15% from yesterday</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-index>
