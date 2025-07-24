@props(['icon', 'category'])

<button
    type="button"
    onclick="toggleModal('destroy-modal-category{{ $category->id }}')"
    {{ $attributes->merge(['class' => 'text-red-500 hover:text-red-700']) }}
>
    <i class="{{ $icon }}"></i>
    {{ $slot }}
</button>
    