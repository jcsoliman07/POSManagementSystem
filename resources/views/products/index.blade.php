
<x-index>
    <x-wrapper>

        <!-- Main Content -->
        <main class="container mx-auto py-6 px-4 product-container">
            <!-- Categories Navigation -->
            <div class="mb-8 overflow-x-auto">
                <div class="flex space-x-4 p-2">

                    <!-- All categories display all products-->
                    <x-buttons.button-product-header
                        type="button" 
                        data-category="all"
                        class="category-btn"
                    >
                        All Categories
                    </x-buttons.button-product-header>

                    <!-- Display all products per Category-->
                    @foreach ($categories as $category)
                        <x-buttons.button-product-header 
                            type="button"
                            class="category-btn" 
                            data-category="{{ $category->name }}"
                        >
                            {{ $category->name }}
                        </x-buttons.button-product-header>
                    @endforeach

                </div>
            </div>

            <!-- Search and Add Product -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-64">

                    <x-forms.search placeholder='Search products...' />
                    <button class="absolute right-3 top-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </div>
                    <x-buttons.button-add-modal target="add-new-product-modal"> Add New Product </x-buttons.button-add-modal>
                    <x-modal.add-new-product-modal :categories="$categories"/>
                </button>
            </div>

            <!-- Product Grid -->
            <div 
                id="productGrid"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6"
            >

                @forelse ($products as $product)

                    @include('products._single', ['product' => $product, 'categories' => $categories])

                @empty

                <!-- If the product is empty -->
                <div class="flex justify-center items-center h-full">
                    <x-forms.paragraph> No Product yet </x-forms.paragraph>
                </div>

                @endforelse

            </div>

                @if ($products->hasMorePages())

                <div class="text-center mt-6">
                    <button class="text-custom-yellow font-medium inline-flex items-center gap-1 hover:scale-105 hover:translate-y-1 transition durations:300 ease-out"
                            id="loadMore"
                            data-url="{{ $products->nextPageUrl() }}"
                    >  
                        Load More
                        <i class="fa-solid fa-angle-down"></i>
                    </button>
                </div>
                    
                @endif
        </main>
    </x-wrapper>

</x-layout>

</body>
</html>

