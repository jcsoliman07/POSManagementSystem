
<div class="sidebar bg-custom-gray text-custom-dark-gray w-64 min-h-screen flex flex-col shadow-lg z-10">
    <!-- Logo -->
    <div class="p-4 flex items-center justify-center border-b border-gray-300">
        <i class="fas fa-utensils text-3xl text-custom-yellow mr-3"></i>
        <span class="text-xl font-bold sidebar-text">POS System</span>
    </div>
    
    <!-- Navigation Items -->
    <div class="flex-1 overflow-y-auto py-4">
        
        <x-navigation.nav-items href="/" :active="request()->is('/')" icon="fas fa-tachometer-alt text-custom-yellow">Dashboard</x-navigation.nav-items>
        <x-navigation.nav-items href="#" icon="fas fa-shopping-cart text-custom-yellow">Order Management</x-navigation.nav-items>
        <x-navigation.nav-items href="/products" :active="request()->is('products')" icon="fas fa-box-open mr-2 text-custom-yellow">Product Management</x-navigation.nav-items>
        <x-navigation.nav-items href="/category" :active="request()->is('category')" icon="fas fa-tags mr-2 text-custom-yellow">Category Management</x-navigation.nav-items>
        <x-navigation.nav-items href="#" icon="fas fa-chart-line text-custom-yellow">Reports & Analytics</x-navigation.nav-items>
        <x-navigation.nav-items href="#" icon="fas fa-user-tie text-custom-yellow">Employee Management</x-navigation.nav-items>
        <x-navigation.nav-items href="#" icon="fas fa-cog text-custom-yellow">Settings</x-navigation.nav-items>

    </div>
    
    <!-- Logout/User Section -->
    <x-navigation.nav-items-logout icon="fas fa-sign-out-alt">Logout</x-navigation.nav-items-logout>
</div>