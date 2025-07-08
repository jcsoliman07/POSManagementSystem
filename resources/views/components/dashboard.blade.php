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
        
        <!-- Status cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-blue-600">Today's Orders</p>
                        <p class="text-2xl font-bold mt-2">{{ $todayOrders }}</p> <!-- Count of Today Orders -->
                    </div>
                    <i class="fas fa-shopping-cart text-blue-400 text-2xl"></i>
                </div>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-green-600">Today's Revenue</p>
                        <p class="text-2xl font-bold mt-2">₱ {{ $todayRevenue }}</p> <!-- Count of Today Revenue or Sales -->
                    </div>
                    <i class="fas fa-peso-sign text-green-400 text-2xl"></i>
                </div>
            </div>
            
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-yellow-600">Active Customers</p>
                        <p class="text-2xl font-bold mt-2">78</p>
                    </div>
                    <i class="fas fa-users text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</x-index>
