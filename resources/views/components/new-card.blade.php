@props(['category', 'icon'])

<div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">

    <div class="bg-custom-light-gray p-6 flex items-center justify-between">

        <div class="flex items-center">

            <div class="w-10 h-10 rounded-full bg-custom-yellow flex items-center justify-center mr-3">
                <i class="fas fa-hamburger text-white"></i>
            </div>
            <h3 class="font-medium text-lg">{{ $category->name }}</h3>

        </div>
        <!-- Edit and Destroy Modal Button-->   
        <div class="flex space-x-2">
            <div>
                <x-buttons.button-edit-category-modal icon="fas fa-edit" :category="$category"/>
                <!--Edit Category Modal Form -->
                <x-modal.edit-modal-category :category="$category" />

                <x-buttons.button-destroy-modal icon="fas fa-trash" :category="$category"/> 
                <!--Destroy Category Modal Form -->
                <x-modal.destroy-modal-category :category="$category" />

            </div>
        </div>  
    </div>

    <div class="p-4">

        <!--Count the Products with each Category -->
        <p class="text-sm text-gray-600 mb-2">
            {{ $category->products_count }} menu item{{ $category->products_count !== 1 ? 's' : '' }}
        </p>
        
        <div class="flex justify-between items-center">

            <span class="text-sm text-gray-500">
                Last updated: {{ $category->updated_at->diffForHumans() }}
            </span>

            <button class=" text-custom-yellow hover:underline">View Items</button>
        </div>

    </div>

</div>