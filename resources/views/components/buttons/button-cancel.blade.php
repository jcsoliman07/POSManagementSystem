
{{-- {{ $attributes(['class' => 'text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5']) }} --}}

<button 
    {{ $attributes(['class' => 'py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-custom-gray hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 border-gray-600 hover:text-white hover:bg-gray-700']) }}
    type="button"
>

{{ $slot }}

</button>