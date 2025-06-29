@props(['target'])


<button 
    data-modal-target="{{ $target }}"
    data-modal-toggle="{{ $target }}"
    class="bg-custom-gray text-white px-6 py-2 rounded-lg font-semibold flex items-center hover:text-custom-gray hover:bg-custom-yellow hover:translate-y-1 transitions-transform duration-200 ease-in-out"
    type="button"
    onclick="toggleModal(this.dataset.modalTarget)"
>
    <i class="fas fa-plus mr-2"></i>
    {{ $slot }} <!-- This will display the text passed to the button -->
</button>
