@props(['label', 'name', 'holder', 'value' => null])


@php    
    $rawValue = old($name, $value);
    $textValue = is_array($rawValue) ? '' :$rawValue;


    $defaults =[
        'id'                => $name,
        'title'             => $name,
        'name'              => $name,
        'placeholder'       => is_array($holder) ? '' : $holder,
        'class'             => 'block w-full p-2.5 bg-custom-light-gray border border-custom-dark-gray rounded-lg block w-full p-2.5 dark:placeholder-gray-400',    
        'rows'              => 4,
];
@endphp


<x-forms.field :$label :$name>
    <textarea {{ $attributes->merge($defaults) }}>{{ ($textValue) }}</textarea>
</x-forms.field>

{{-- 
<div class="sm:col-span-2">
    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
    <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
</div> --}}