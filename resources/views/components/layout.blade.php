<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-gray': '#1F1F1F',
                        'custom-yellow': '#E9BB3F',
                        'custom-light-gray': '#F6F6F6',
                        'custom-dark-gray': '#979797',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-icon {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover .sidebar-icon {
            transform: scale(1.1);
        }
        .sidebar-item.active .sidebar-icon {
            color: #E9BB3;
        }
        .content-area {
            transition: margin-left 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar-text {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-custom-light-gray font-sans flex h-screen overflow-hidden">

    <!-- Sidebar Navigation -->
    <x-nav-link />

    <main>

    </main>

    <!-- Main Content Area -->
    <div class="content-area flex-1 overflow-auto">
        <!-- Top Navigation -->
        <x-top-nav />
        
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <div class="p-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold mb-4">Welcome to your POS System</h2>
                <p class="text-gray-600">This is the main content area. You can add your POS components here.</p>
                
                <!-- Sample stats cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-blue-600">Today's Orders</p>
                                <p class="text-2xl font-bold mt-2">142</p>
                            </div>
                            <i class="fas fa-shopping-cart text-blue-400 text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-green-600">Today's Revenue</p>
                                <p class="text-2xl font-bold mt-2">₱24,578</p>
                            </div>
                            <i class="fas fa-peso-sign text-green-400 text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-yellow-600">Active Customers</p>
                                <p class="text-2xl font-bold mt-2">78</p>
                            </div>
                            <i class="fas fa-users text-yellow-400 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
            document.querySelector('.content-area').classList.toggle('ml-64');
        });

        // Set active state for sidebar items
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
