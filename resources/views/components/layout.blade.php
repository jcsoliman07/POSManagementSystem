<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Management System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Cusom CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    <!-- Char CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body class="bg-custom-light-gray font-sans flex h-screen overflow-hidden">

    {{ $slot }}

<!-- Cusom JS -->
<script src="{{ asset('js/global.js') }}"></script>
</body>
</html>
