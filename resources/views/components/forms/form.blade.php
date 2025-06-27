@props([
    'method' => 'POST',
    'action' => '',
])

@php
    $formMethod = strtoupper($method);
@endphp

<form
    action="{{ $action }}"
    method="{{ in_array($formMethod, ['GET', 'POST']) ? $formMethod : 'POST' }}"
    {{ $attributes->merge(['class' => 'max-w-full mx-auto space-y-6']) }}
>
    @if (!in_array($formMethod, ['GET', 'POST']))
        @csrf
        @method($formMethod)
    @elseif ($formMethod === 'POST')
        @csrf
    @endif

    {{ $slot }}
</form>
