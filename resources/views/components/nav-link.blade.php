
<div class="sidebar bg-custom-gray text-custom-dark-gray w-64 min-h-screen flex flex-col shadow-lg z-10">
    <!-- Logo -->
    <div class="p-4 flex items-center justify-center border-b border-gray-300">
        <i class="fas fa-utensils text-3xl text-custom-yellow mr-3"></i>
        <span class="text-xl font-bold sidebar-text">POS System</span>
    </div>
    
    <!-- Navigation Items -->
    <div class="flex-1 overflow-y-auto py-4">
        
        <x-nav-items href="/" icon="fas fa-tachometer-alt text-custom-yellow">Dashboard</x-nav-items>
        <x-nav-items href="#" icon="fas fa-shopping-cart text-custom-yellow">Order Management</x-nav-items>
        <x-nav-items href="#" icon="fas fa-box-open mr-2 text-custom-yellow">Product Management</x-nav-items>
        <x-nav-items href="/category" icon="fas fa-tags mr-2 text-custom-yellow">Category Management</x-nav-items>
        <x-nav-items href="#" icon="fas fa-chart-line text-custom-yellow">Reports & Analytics</x-nav-items>
        <x-nav-items href="#" icon="fas fa-user-tie text-custom-yellow">Employee Management</x-nav-items>
        <x-nav-items href="#" icon="fas fa-cog text-custom-yellow">Settings</x-nav-items>

    </div>
    
    <!-- Logout/User Section -->
    <x-nav-items-logout icon="fas fa-sign-out-alt">Logout</x-nav-items-logout>
</div>