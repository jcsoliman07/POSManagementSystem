
@if (session('error') || $errors->any())
    <div class="mt-8 w-full">
        <div id="errorAlert" class="fixed top-0 left-0 w-full flex justify-center p-4 z-50 hidden">
            <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center border border-red-600">
                {{-- <i class="fas fa-check-circle mr-2"></i> --}}

                @if (session('error'))
                    <button onclick="hideAlert()" class="ml-4 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                        <span>{{ session('error') }}</span>
                    </button>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <button onclick="hideAlert()" class="ml-4 text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                            <span>{{ $error }}</span>
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif



@if(session('error') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('errorAlert');
            alertBox.classList.remove('hidden');

            // Auto-hide after 3 seconds
            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 3000);
        });

        function hideAlert() {
            document.getElementById('errorAlert').classList.add('hidden');
        }
    </script>
@endif