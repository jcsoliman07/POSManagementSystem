@props(['name','label', 'holder','id' => null, 'value' => ''])

@php
    $rawValue = old($name, $value); //Make sure data is not an array

    $inputValue = is_array($rawValue) ? '' : $rawValue;  // This allows old() to override on validation error, otherwise uses $value

    $defaults=[
        'type'  => 'text',
        'id'    => $name,
        'name'  => $name,
        'class' => 'bg-custom-light-gray border border-light-gray text-custom-gray text-sm rounded-lg block w-full p-2.5 dark:placeholder-gray-400',
        'placeholder' => $holder,
        'value' => $inputValue,
];

@endphp

<x-forms.field :$label :$name>
    
    <input {{ $attributes->merge($defaults) }}>

</x-forms.field>