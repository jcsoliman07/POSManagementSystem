@props(['icon', 'product'])

{{-- text-white px-3 py-1 rounded-lg text-sm --}}
<button
    type="button"
    onclick="toggleModal('edit-modal-product{{ $product->id }}')"
    {{ $attributes->merge(['class' => 'font-bold text-custom-gray px-3 py-1 rounded-lg text-md hover:text-custom-yellow hover:scale-105 hover:scale-y-1 transistion-all duration-200 ease-in-out']) }}
>
    {{ $slot }}
</button>
 

{{-- @props(['icon', 'category'])

<button
    type="button"
    onclick="toggleModal('edit-modal-category{{ $category->id }}')"
    {{ $attributes->merge(['class' => 'text-blue-500 hover:text-blue-700']) }}
>
    <i class="{{ $icon }}"></i>
    {{ $slot }}
</button>
     --}}