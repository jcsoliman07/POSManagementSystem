
<div class="bg-white shadow-sm p-4 flex items-center justify-between">
    <div class="flex items-center">
        <button id="toggleSidebar" class="md:hidden mr-4 text-gray-600">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <x-nav-heading>Dashboard Overview</x-nav-heading>
        {{-- <h1 class="text-xl font-semibold">Dashboard Overview</h1> <!--This will be Logo--> --}}
    </div>
    <div class="flex items-center space-x-6">
        <div class="flex items-center">
            {{-- <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-full w-8 h-8 mr-2"> --}}
            <x-forms.paragraph>
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
            </x-forms.paragraph>
        </div>
    </div>
</div>