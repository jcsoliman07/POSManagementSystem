
<div data-category="{{ $product->category->name }}" class="product-card group bg-white rounded-xl shadow-lg overflow-hidden hover:scale-105 hover:translate-y-1 transition-transform duration-300 mb-8 ">
    <div class="relative h-48">
        <!--  AYUSIN KITA AFTER KO SA USER MODULE  -->
        {{-- <img 
            src="{{ asset('storage/' .$product->image) }}" 
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 ease-in-out"
        > --}}
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0ccf4480-0602-495d-a9c5-2bec980bb886.png" alt="{{ $product->description }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 ease-in-out">
        {{-- {{-- <span class="absolute top-3 right-3 bg-custom-yell -backdrop-hue-rotate-15ow text-custom-gray px-2 py-1 rounded-full font-bold text-sm">Best Seller</span> --}}
    </div>
    <div class="p-4">
        <h3 class="font-bold text-lg mb-1">{{ $product->name }}</h3>

        <x-forms.paragraph class="text-sm mb-2">{{ $product->description }}</x-forms.paragraph>

        <div class="flex justify-between items-center">
            <x-forms.span class=" text-custom-yellow "> ₱ {{ $product->price }} </x-forms.span>

            <!-- Button to Open Modal-->
            <x-buttons.button-edit-product-modal :product="$product"> Manage </x-buttons.button-edit-product-modal>
            <!-- Edit Modal Product-->

            <x-forms.border-bottom-hover/>

        </div>
    </div>
</div>

<x-modal.edit-modal-product :product="$product" :categories="$categories"/>