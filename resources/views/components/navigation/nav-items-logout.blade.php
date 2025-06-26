@props(['icon'])

<div class="p-4 border-t border-gray-300">
    <div class="flex items-center cursor-pointer hover:bg-gray-200 hover:text-custom-yellow p-2 rounded transition-all durations-500 ease-in-out">
        <div class="sidebar-icon text-xl w-8 text-center mr-3">
            <i class="{{ $icon }}"></i>
        </div>
        <span class="sidebar-text">{{ $slot }}</span>
    </div>
</div>