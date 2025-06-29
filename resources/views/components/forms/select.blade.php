@props(['label', 'name'])

@php
    $defaults =[
        'id'        => $name,
        'name'      => $name,
        'class'     => 'bg-custom-light-gray border border-custom-dark-gray text-custom-gray text-sm rounded-lg block w-full p-2.5 dark:placeholder-gray-400'
    ]
@endphp


<x-forms.field :$label :$name>
    <select {{ $attributes->merge($defaults)}}>
        {{ $slot }}
    </select>
</x-forms.field>