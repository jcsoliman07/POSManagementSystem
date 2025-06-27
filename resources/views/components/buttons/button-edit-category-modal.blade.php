@props(['icon', 'category'])

<button
    type="button"
    onclick="openModalCategory('edit-modal-category{{ $category->id }}')"
    {{ $attributes->merge(['class' => 'text-blue-500 hover:text-blue-700']) }}
>
    <i class="{{ $icon }}"></i>
    {{ $slot }}
</button>
    