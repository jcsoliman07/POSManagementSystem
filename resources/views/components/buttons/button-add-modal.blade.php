
<button 
    data-modal-target="add-new-modal" 
    data-modal-toggle="add-new-modal" 
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
    type="button"
    onclick="toggleModal()"
>
    <i class="fas fa-plus mr-2"></i>
    {{ $slot }} <!-- This will display the text passed to the button -->
</button>
