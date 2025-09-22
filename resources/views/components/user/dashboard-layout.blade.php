<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ explode(' ', auth()->user()->nama)[0] }} - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Fallback if Tailwind CDN fails
        if (typeof tailwind === 'undefined') {
            console.warn('Tailwind CSS CDN failed to load');
        }
    </script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
</head>
<body class="bg-gray-50">
    <!-- Dashboard Layout Component -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-user.sidebar />
        
        <!-- Mobile Toggle -->
        <x-user.mobile-toggle />
        
        <!-- Right Side Content Area -->
        <div class="ml-0 sm:ml-0 md:ml-[280px] lg:ml-[300px] flex-1 flex flex-col transition-all duration-300 ease-in-out">
            <!-- Header -->
            <x-user.header />
            
            <!-- Main Content Slot -->
            <main class="flex-1 p-3 sm:p-4 md:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('aside');
        const overlay = document.getElementById('overlay');
        const burgerIcon = document.getElementById('burgerIcon');
        const closeIcon = document.getElementById('closeIcon');
        const burgerBtn = document.getElementById('burgerBtn');
        
        // Toggle sidebar visibility
        if (sidebar.classList.contains('-translate-x-full')) {
            // Open sidebar
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            
            // Change icon to close
            burgerIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            burgerBtn.classList.add('bg-red-600');
            burgerBtn.classList.remove('bg-[#0F044C]');
        } else {
            // Close sidebar
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            
            // Change icon back to burger
            closeIcon.classList.add('hidden');
            burgerIcon.classList.remove('hidden');
            burgerBtn.classList.remove('bg-red-600');
            burgerBtn.classList.add('bg-[#0F044C]');
        }
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('aside');
        const toggle = document.getElementById('burgerBtn');
        const overlay = document.getElementById('overlay');
        const burgerIcon = document.getElementById('burgerIcon');
        const closeIcon = document.getElementById('closeIcon');
        
        if (window.innerWidth <= 768 && 
            !sidebar.contains(e.target) && 
            !toggle.contains(e.target)) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            
            // Reset button state
            closeIcon.classList.add('hidden');
            burgerIcon.classList.remove('hidden');
            toggle.classList.remove('bg-red-600');
            toggle.classList.add('bg-[#0F044C]');
        }
    });
    
    // Close sidebar on window resize to desktop
    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('aside');
        const overlay = document.getElementById('overlay');
        const burgerIcon = document.getElementById('burgerIcon');
        const closeIcon = document.getElementById('closeIcon');
        const burgerBtn = document.getElementById('burgerBtn');
        
        if (window.innerWidth > 768) {
            // Reset mobile state
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            
            // Reset button state
            closeIcon.classList.add('hidden');
            burgerIcon.classList.remove('hidden');
            burgerBtn.classList.remove('bg-red-600');
            burgerBtn.classList.add('bg-[#0F044C]');
        }
    });
</script>
</body>
</html> 