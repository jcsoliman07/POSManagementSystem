@props(['title', 'icon', 'route', 'active' => false])

{{-- px-4 py-6 flex items-center cursor-pointer hover:bg-gray-200 hover:text-custom-gray transition-all duration-500 ease-in-out --}}



<a class="{{ $active ? ' rounded-l-lg ml-2 bg-gray-200 text-custom-gray' : 'rounded-l-lg hover:ml-2 hover:bg-gray-200 hover:text-custom-gray'}} px-4 py-6 flex items-center cursor-pointer transition-all duration-500 ease-in-out"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }} >

    <div class="text-xl w-8 text-center mr-3">
        <i class="{{ $icon }}"></i>
    </div>

    <span class="sidebar-text">{{ $slot }}</span>
</a>