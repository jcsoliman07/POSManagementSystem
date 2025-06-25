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
