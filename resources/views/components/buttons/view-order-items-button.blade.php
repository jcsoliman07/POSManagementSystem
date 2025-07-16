@props(['order'])

<button
    type="button"
    onclick="toggleModal('view-order-items-modal{{ $order->id }}')"
    {{ $attributes->merge(['class' => 'text-indigo-600 hover:text-indigo-900']) }}
>
    {{ $slot }}
</button>
