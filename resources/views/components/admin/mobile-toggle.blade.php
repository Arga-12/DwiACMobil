<!-- Admin Mobile Toggle Component -->
<button class="fixed top-4 left-4 z-50 bg-[#0F044C] text-white p-3 rounded-lg shadow-lg lg:hidden md:hidden sm:block transition-all duration-300 hover:bg-[#141E61] active:scale-95" onclick="toggleSidebar()" id="burgerBtn">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="burgerIcon">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
    <svg class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="closeIcon">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<!-- Overlay for mobile -->
<div class="fixed inset-0 bg-black bg-opacity-60 z-30 lg:hidden md:hidden sm:block opacity-0 pointer-events-none transition-all duration-300 backdrop-blur-sm" id="overlay" onclick="toggleSidebar()"></div>
