<x-admin.dashboard-layout title="Admin Dashboard - Dwi AC Mobil">
    @vite(['resources/js/admin/dashboard-transisi.js', 'resources/js/admin/kalender.js'])
    
    <style>
        .dashboard-mode {
            transition: opacity 300ms ease-in-out;
        }
        .dashboard-mode.hidden {
            display: none;
        }
    </style>
    
    <!-- Dashboard Content dengan Dual Mode -->
    <div>
        <!-- Include Dashboard Components -->
        @include('admin.dashboard-bengkel')
        @include('admin.dashboard-website')
    </div>
</x-admin.dashboard-layout>