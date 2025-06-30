

<div class="mt-8 w-full">
    <div id="warningAlert" class="fixed top-0 left-0 w-full flex justify-center p-4 z-50 hidden">
        <div class="bg-custom-yellow text-white px-4 py-3 rounded-lg shadow-lg flex items-center border border-custom-yellow">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('warning') }}</span>
            <button onclick="hideAlert()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>


@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('warningAlert');
            alertBox.classList.remove('hidden');

            // Auto-hide after 3 seconds
            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 3000);
        });

        function hideAlert() {
            document.getElementById('warningAlert').classList.add('hidden');
        }
    </script>
@endif