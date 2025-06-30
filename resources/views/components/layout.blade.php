<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="{{ asset('js/global.js') }}"></script>
    <style>
        #screen-loader {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        #screen-loader.active {
            display: flex;
        }
        .loader {
            width: 48px;
            height: 48px;
            border: 4px solid white;
            border-top: 4px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0); }
            100% { transform: rotate(360deg); }
        }
    </style>
    
</head>
<body class="bg-custom-light-gray font-sans flex h-screen overflow-hidden">


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
        
    </div>
</body>
</html>
