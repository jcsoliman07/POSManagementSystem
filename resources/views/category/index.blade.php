<x-layout>

    <x-wrapper>

        <x-alert.success/>

        <x-forms.heading>Category Management</x-forms.heading>
        <x-forms.paragraph>Manage your Categories here.</x-forms.paragraph>

            <div class="mb-4">
                <x-buttons.button-add-modal>New</x-buttons.button-add-modal>
                <x-modal.add-new-modal />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($categories as $category)
                    <x-new-card :$category />
                @endforeach 
            </div>          
        </div>
        
    </x-wrapper>
    
</x-layout>