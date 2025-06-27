

<div class="mt-8 w-full">
    <div id="successAlert" class="fixed top-0 left-0 w-full flex justify-center p-4 z-50 hidden">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
            <button onclick="hideAlert()" class="ml-4 text-green-600 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('successAlert');
            alertBox.classList.remove('hidden');

            // Auto-hide after 3 seconds
            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 3000);
        });

        function hideAlert() {
            document.getElementById('successAlert').classList.add('hidden');
        }
    </script>
@endif