@props(['title', 'icon'])

<div class="sidebar-item active px-4 py-6 flex items-center cursor-pointer hover:bg-gray-200 hover:text-custom-gray transition-all duration-500 ease-in-out">
    <div class="sidebar-icon text-xl w-8 text-center mr-3">
        <i class="{{ $icon }}"></i>
    </div>
    <span class="sidebar-text">{{ $slot }}</span>
</div>