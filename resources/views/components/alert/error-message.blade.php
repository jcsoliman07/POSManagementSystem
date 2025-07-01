
@if (session('error'))
    <div class="mt-8 w-full">
        <div class="bg-red-600 text-sm text-white px-4 py-3 rounded-lg shadow-lg flex items-center border border-red-600">
            <i class="fas fa-times mr-2"></i>
            <span>{{ session('error')}}</span>
        </div>
    </div>
@endif
