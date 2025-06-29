
@props(['type', 'title'])

@php
    $defaults =[
        'type' => $type,
        'class' => 'px-6 py-2 rounded-full bg-custom-light-gray shadow hover:bg-custom-yellow hover:scale-105 hover:translate-y-1 transition-transform duration-300 ease-in-out',
    ]
@endphp

<button 
    {{ $attributes->merge($defaults) }}
>
    {{ $slot }}
</button>