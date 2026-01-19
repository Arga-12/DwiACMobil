<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ explode(' ', auth()->user()->nama)[0] }} - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="/css/custom-fonts.css">
    @vite(['resources/js/users/dashboard.js'])
    @vite(['resources/js/users/pilih-tgl-booking.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Dashboard Layout Component -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-user.sidebar />
        
        <!-- Mobile Toggle -->
        <x-user.mobile-toggle />
        
        <!-- Right Side Content Area -->
        <div class="content-area ml-0 sm:ml-0 md:ml-[280px] lg:ml-[300px] flex-1 flex flex-col">
            <!-- Header -->
            <x-user.header />
            
            <!-- Main Content Slot -->
            <main class="flex-1 p-3 sm:p-4 md:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
    // Simple mobile open/close (no collapsed mode)
    function toggleSidebar() {
        const sidebar = document.querySelector('aside.sidebar');
        const overlay = document.getElementById('overlay');
        const burgerIcon = document.getElementById('burgerIcon');
        const closeIcon = document.getElementById('closeIcon');
        const btn = document.getElementById('burgerBtn');

        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0','pointer-events-none');
            overlay.classList.add('opacity-100');
            burgerIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            btn.classList.add('bg-red-600');
            btn.classList.remove('bg-[#0F044C]');
        } else {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0','pointer-events-none');
            closeIcon.classList.add('hidden');
            burgerIcon.classList.remove('hidden');
            btn.classList.remove('bg-red-600');
            btn.classList.add('bg-[#0F044C]');
        }
    }

    // Close when clicking outside on mobile
    document.addEventListener('click', (e) => {
        const sidebar = document.querySelector('aside.sidebar');
        const overlay = document.getElementById('overlay');
        const btn = document.getElementById('burgerBtn');
        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !btn.contains(e.target)) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0','pointer-events-none');
            const burgerIcon = document.getElementById('burgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            closeIcon.classList.add('hidden');
            burgerIcon.classList.remove('hidden');
            btn.classList.remove('bg-red-600');
            btn.classList.add('bg-[#0F044C]');
        }
    });

    // Ensure visible on desktop
    window.addEventListener('resize', () => {
        const sidebar = document.querySelector('aside.sidebar');
        const overlay = document.getElementById('overlay');
        if (window.innerWidth > 768) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.add('opacity-0','pointer-events-none');
            overlay.classList.remove('opacity-100');
        }
    });
    </script>
</body>
</html> 