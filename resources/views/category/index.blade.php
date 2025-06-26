<x-layout>

    <x-wrapper>

        <x-forms.heading>Category Management</x-forms.heading>
        <x-forms.paragraph>Manage your Categories here.</x-forms.paragraph>

        <div class="mt-8 w-full">
            <x-forms.form>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($categories as $category)
                            <x-new-card :$category />
                        @endforeach 
                    </div>          
            </x-forms.form>
        </div>
        
    </x-wrapper>
    
</x-layout>