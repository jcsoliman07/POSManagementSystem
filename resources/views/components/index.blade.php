<x-layout>

    <!-- Sidebar Navigation -->
    <x-navigation.nav-link />

    <!-- Main Content Area -->
    <div class="content-area flex-1 overflow-auto">
    <x-alert.success/>
    <x-alert.warning/>
    <x-alert.error/>

        <!-- Top Navigation -->
        <x-top-nav />
        
        <!-- Page Content -->
        <main>
            <div class="space-y-10">
                <section class="p-6 mt-4">
                    {{ $slot }}
                </section>
            </div>
        </main>

</x-layout>