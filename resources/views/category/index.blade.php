<x-index>

    <x-wrapper>

        <main class="category-container">
            <x-forms.heading>Category Management</x-forms.heading>
            <x-forms.paragraph class="text-md mb-6 border-b pb-2">Manage your Categories here.</x-forms.paragraph>

                <div class="mb-4">
                    <x-buttons.button-add-modal target="add-new-category-modal">New</x-buttons.button-add-modal>
                    <x-modal.add-new-category-modal />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 category-card">
                    @forelse ($categories as $category)
                        <x-new-card :$category />
                    @empty
                </div>
                    <div class="flex justify-center items-center h-full">
                        <x-forms.paragraph> No Category yet </x-forms.paragraph>
                    </div>
                    @endforelse

                {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($categories as $category)
                        <x-new-card :$category />
                    @endforeach 
                </div>           --}}
            </div>
        </main>
        
    </x-wrapper>
    
</x-layout>