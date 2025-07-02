
@if ($errors->any())
    <div class="mt-8 w-full">
        <div class="bg-red-600 text-sm text-white px-4 py-3 rounded-lg shadow-lg flex items-center border border-red-600">
            @foreach ($errors->all() as $error)
                <i class="fas fa-times mr-2"></i>
                <span>{{ $error}}</span>
            @endforeach
        </div>
    </div>
@endif
