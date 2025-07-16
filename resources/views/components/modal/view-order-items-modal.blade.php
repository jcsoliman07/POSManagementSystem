@props(['order'])
<!-- Order Items -->

<div id="view-order-items-modal{{ $order->id }}"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300 ease-out"
>
    <h1>{{ $order->id }}</h1>
</div>