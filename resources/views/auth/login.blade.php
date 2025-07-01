<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Management System Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/global.js') }}"></script>

</head>
<body class="min-h-screen bg-custom-light-gray">
    
    <div class="flex flex-col md:flex-row h-screen">

        <!-- Company image -->
        <div class="w-full md:w-1/2 bg-custom-gray relative overflow-hidden">
            <div class="">
                <img 
                    src="/storage/background-login.jpg" 
                    alt="Background Image" 
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
        <div class="w-full md:w-1/2 flex items-center justify-center p-4 md:p-8">
            <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Welcome Back</h2>
                <p class="text-custom-dark-gray mb-6">Sign in to your account</p>
                
                <x-alert.error-message/>
                {{-- <x-alert.error-message field="email"/>
                <x-alert.error-message field="password"/> --}}

                <x-forms.form action="/login" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-custom-yellow focus:border-transparent transition duration-200"
                            placeholder="Enter your email" required>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-custom-yellow focus:border-transparent transition duration-200"
                            placeholder="Enter your password" required>
                    </div>
                    <button type="submit" 
                        class="w-full bg-custom-yellow text-white py-3 px-4 rounded-lg font-medium hover:bg-amber-500 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-yellow">
                        Sign In
                    </button>

                </x-forms.form>
                
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <p class="text-xs text-custom-dark-gray text-center">© 2023 POS Management System - Jomar Soliman. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>