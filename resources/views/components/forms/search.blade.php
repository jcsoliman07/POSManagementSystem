
@props(['type', 'holder'])

@php
    $defaults =[
        'type' => 'text',
        'placeholder' => '$holder',
        'class' => 'w-full px-4 py-2 bg-custom-light-gray rounded-full shadow',
    ]
@endphp

<input {{ $attributes($defaults) }}>