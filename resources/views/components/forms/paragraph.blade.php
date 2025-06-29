{{-- class="text-md text-gray-600 mb-6 border-b pb-2"> --}}


<p 
    @class([
        'text-gray-600',
        $class ?? ''
    ])
>
    {{ $slot }}
</p>
