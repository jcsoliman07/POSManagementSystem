<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="{{ asset('js/global.js') }}"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-gray': '#1f1f1f',
                        'custom-yellow': '#E9BB3F',
                        'custom-light-gray': '#F6F6F6',
                        'custom-dark-gray': '#979797',
                    }
                }
            }
        }
    </script>
    
</head>
<body class="bg-custom-light-gray font-sans flex h-screen overflow-hidden">


    <!-- Sidebar Navigation -->
    <x-navigation.nav-link />

    <!-- Main Content Area -->
    <div class="content-area flex-1 overflow-auto">

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
        
    </div>
</body>
</html>
