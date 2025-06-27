

<button 
    type="submit"
    {{ $attributes(['class' => ' py-2.5 px-5 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5']) }}
>
    {{ $slot }}
</button>