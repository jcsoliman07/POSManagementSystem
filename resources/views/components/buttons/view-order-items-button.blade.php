@props([])

<button
    type="button"
    onclick="toggleModal('view-order-items-modal')"
    {{ $attributes->merge(['class' => 'text-indigo-600 hover:text-indigo-900']) }}
>
    {{ $slot }}
</button>
